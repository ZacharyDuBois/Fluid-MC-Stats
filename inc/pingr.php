<?php
error_reporting(0);
class MinecraftPingException extends Exception
{
	//
}

class MinecraftPing
{
	/*
	 * Queries Minecraft server
	 * Returns array on success, false on failure.
	 *
	 * WARNING: This method was added in snapshot 13w41a (Minecraft 1.7)
	 *
	 * Written by xPaw
	 *
	 * Website: http://xpaw.ru
	 * GitHub: https://github.com/xPaw/PHP-Minecraft-Query
	 *
	 * ---------
	 *
	 * This method can be used to get server-icon.png too.
	 * Something like this:
	 *
	 * $Server = new MinecraftPing( 'localhost' );
	 * $Info = $Server->Query();
	 * echo '<img width="64" height="64" src="' . Str_Replace( "\n", "", $Info[ 'favicon' ] ) . '">';
	 *
	 */
	
	private $Socket;
	private $ServerAddress;
	private $ServerPort;
	private $Timeout;
	
	public function __construct( $Address, $Port = 25565, $Timeout = 2 )
	{
		$this->ServerAddress = $Address;
		$this->ServerPort = (int)$Port;
		$this->Timeout = (int)$Timeout;
		
		$this->Connect( );
	}
	
	public function __destruct( )
	{
		$this->Close( );
	}
	
	public function Close( )
	{
		if( $this->Socket !== null )
		{
			fclose( $this->Socket );
			
			$this->Socket = null;
		}
	}
	
	public function Connect( )
	{
		$connectTimeout = $this->Timeout;
		$this->Socket = @fsockopen( $this->ServerAddress, $this->ServerPort, $errno, $errstr, $connectTimeout );
		
		if( !$this->Socket )
		{
			throw new MinecraftPingException( "Failed to connect or create a socket: $errno ($errstr)" );
		}
		
		// Set Read/Write timeout
		stream_set_timeout( $this->Socket, $this->Timeout );
	}
	
	public function Query( )
	{
		$TimeStart = microtime(true); // for read timeout purposes
		
		// See http://wiki.vg/Protocol (Status Ping)
		$Data = "\x00"; // packet ID = 0 (varint)
		
		$Data .= "\x04"; // Protocol version (varint)
		$Data .= Pack( 'c', StrLen( $this->ServerAddress ) ) . $this->ServerAddress; // Server (varint len + UTF-8 addr)
		$Data .= Pack( 'n', $this->ServerPort ); // Server port (unsigned short)
		$Data .= "\x01"; // Next state: status (varint)
		
		$Data = Pack( 'c', StrLen( $Data ) ) . $Data; // prepend length of packet ID + data
		
		fwrite( $this->Socket, $Data ); // handshake
		fwrite( $this->Socket, "\x01\x00" ); // status ping
		
		$Length = $this->ReadVarInt( ); // full packet length
		
		if( $Length < 10 )
		{
			return FALSE;
		}
		
		fgetc( $this->Socket ); // packet type, in server ping it's 0
		
		$Length = $this->ReadVarInt( ); // string length
		
		$Data = "";
		do
		{
			if (microtime(true) - $TimeStart > $this->Timeout)
			{
				throw new MinecraftPingException( 'Server read timed out' );
			}
			
			$Remainder = $Length - StrLen( $Data );
			$block = fread( $this->Socket, $Remainder ); // and finally the json string
			// abort if there is no progress
			if (!$block)
			{
				throw new MinecraftPingException( 'Server returned too few data' );
			}
			
			$Data .= $block;
		} while( StrLen($Data) < $Length );
		
		if( $Data === FALSE )
		{
			throw new MinecraftPingException( 'Server didn\'t return any data' );
		}
		
		$Data = JSON_Decode( $Data, true );
		
		if( JSON_Last_Error( ) !== JSON_ERROR_NONE )
		{
			if( Function_Exists( 'json_last_error_msg' ) )
			{
				throw new MinecraftPingException( JSON_Last_Error_Msg( ) );
			}
			else
			{
				throw new MinecraftPingException( 'JSON parsing failed' );
			}
			
			return FALSE;
		}
		
		return $Data;
	}
	
	public function QueryOldPre17( )
	{
		fwrite( $this->Socket, "\xFE\x01" );
		$Data = fread( $this->Socket, 512 );
		$Len = StrLen( $Data );
		
		if( $Len < 4 || $Data[ 0 ] !== "\xFF" )
		{
			return FALSE;
		}
		
		$Data = SubStr( $Data, 3 ); // Strip packet header (kick message packet and short length)
		$Data = iconv( 'UTF-16BE', 'UTF-8', $Data );
		
		// Are we dealing with Minecraft 1.4+ server?
		if( $Data[ 1 ] === "\xA7" && $Data[ 2 ] === "\x31" )
		{
			$Data = Explode( "\x00", $Data );
			
			return Array(
				'HostName'   => $Data[ 3 ],
				'Players'    => IntVal( $Data[ 4 ] ),
				'MaxPlayers' => IntVal( $Data[ 5 ] ),
				'Protocol'   => IntVal( $Data[ 1 ] ),
				'Version'    => $Data[ 2 ]
			);
		}
		
		$Data = Explode( "\xA7", $Data );
		
		return Array(
			'HostName'   => SubStr( $Data[ 0 ], 0, -1 ),
			'Players'    => isset( $Data[ 1 ] ) ? IntVal( $Data[ 1 ] ) : 0,
			'MaxPlayers' => isset( $Data[ 2 ] ) ? IntVal( $Data[ 2 ] ) : 0,
			'Protocol'   => 0,
			'Version'    => '1.3'
		);
	}
	
	private function ReadVarInt( )
	{
		$i = 0;
		$j = 0;
		
		while( true )
		{
			$k = @fgetc( $this->Socket );
			
			if( $k === FALSE )
			{
				return 0;
			}
			
			$k = Ord( $k );
			
			$i |= ( $k & 0x7F ) << $j++ * 7;
			
			if( $j > 5 )
			{
				throw new MinecraftPingException( 'VarInt too big' );
			}
			
			if( ( $k & 0x80 ) != 128 )
			{
				break;
			}
		}
		
		return $i;
	}
}
function MineToWeb($minetext){
preg_match_all("/[^§&]*[^§&]|[§&][0-9a-z][^§&]*/", $minetext, $brokenupstrings);
$returnstring = "";
foreach ($brokenupstrings as $results){
$ending = '';
foreach ($results as $individual){
$code = preg_split("/[&§][0-9a-z]/", $individual);
preg_match("/[&§][0-9a-z]/", $individual, $prefix);
if (isset($prefix[0])){
$actualcode = substr($prefix[0], 1);
switch ($actualcode){
case "1":
$returnstring = $returnstring.'<FONT COLOR="0000AA">';
$ending = $ending ."</FONT>";
break;
case "2":
$returnstring = $returnstring.'<FONT COLOR="00AA00">';
$ending =$ending ."</FONT>";
break;
case "3":
$returnstring = $returnstring.'<FONT COLOR="00AAAA">';
$ending = $ending ."</FONT>";
break;
case "4":
$returnstring = $returnstring.'<FONT COLOR="AA0000">';
$ending =$ending ."</FONT>";
break;
case "5":
$returnstring = $returnstring.'<FONT COLOR="AA00AA">';
$ending =$ending . "</FONT>";
break;
case "6":
$returnstring = $returnstring.'<FONT COLOR="FFAA00">';
$ending =$ending ."</FONT>";
break;
case "7":
$returnstring = $returnstring.'<FONT COLOR="AAAAAA">';
$ending = $ending ."</FONT>";
break;
case "8":
$returnstring = $returnstring.'<FONT COLOR="555555">';
$ending =$ending ."</FONT>";
break;
case "9":
$returnstring = $returnstring.'<FONT COLOR="5555FF">';
$ending =$ending . "</FONT>";
break;
case "a":
$returnstring = $returnstring.'<FONT COLOR="55FF55">';
$ending =$ending ."</FONT>";
break;
case "b":
$returnstring = $returnstring.'<FONT COLOR="55FFFF">';
$ending = $ending ."</FONT>";
break;
case "c":
$returnstring = $returnstring.'<FONT COLOR="FF5555">';
$ending =$ending ."</FONT>";
break;
case "d":
$returnstring = $returnstring.'<FONT COLOR="FF55FF">';
$ending =$ending ."</FONT>";
break;
case "e":
$returnstring = $returnstring.'<FONT COLOR="FFFF55">';
$ending = $ending ."</FONT>";
break;
case "f":
$returnstring = $returnstring.'<FONT COLOR="FFFFFF">';
$ending =$ending ."</FONT>";
break;
case "l":
if (strlen($individual)>2){
$returnstring = $returnstring.'<span style="font-weight:bold;">';
$ending = "</span>".$ending;
break;
}
case "m":
if (strlen($individual)>2){
$returnstring = $returnstring.'<strike>';
$ending = "</strike>".$ending;
break;
}
case "n":
if (strlen($individual)>2){
$returnstring = $returnstring.'<span style="text-decoration: underline;">';
$ending = "</span>".$ending;
break;
}
case "o":
if (strlen($individual)>2){
$returnstring = $returnstring.'<i>';
$ending ="</i>".$ending;
break;
}
case "r":
$returnstring = $returnstring.$ending;
$ending = '';
break;
}
if (isset($code[1])){
$returnstring = $returnstring.$code[1];
if (isset($ending)&&strlen($individual)>2){
$returnstring = $returnstring.$ending;
$ending = '';
}
}
}
else{
$returnstring = $returnstring.$individual;
}

}
}

return $returnstring;
}
	class Pingr {
	function getStats($address) {
	$address = explode(':', $address);
	if(!empty($address[1])) {
	$port = $address[1];
	} else {
	$port = 25565;
	}
	if(!empty($address[0])) {
	$ip = $address[0];
	} else {
	$ip = localhost;
	}
	// Edit this ->
	define( 'MQ_SERVER_ADDR', $ip );
	define( 'MQ_SERVER_PORT', $port );
	define( 'MQ_TIMEOUT', 1 );
	// Edit this <-

	$Timer = MicroTime( true );

	$Info = false;
	$Query = null;

	try
	{
		$Query = new MinecraftPing( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );

		$Info = $Query->Query( );

		if( $Info === false )
		{
			/*
			 * If this server is older than 1.7, we can try querying it again using older protocol
			 * This function returns data in a different format, you will have to manually map
			 * things yourself if you want to match 1.7's output
			 *
			 * If you know for sure that this server is using an older version,
			 * you then can directly call QueryOldPre17 and avoid Query() and then reconnection part
			 */

			$Query->Close( );
			$Query->Connect( );

			$Info = $Query->QueryOldPre17( );
		}
	}
	catch( MinecraftPingException $e )
	{
		$Exception = $e;
	}

	if( $Query !== null )
	{
		$Query->Close( );
	}
	//**simplifier**//
	$fp = fsockopen($ip, $port, $errno, $errstr, 30);
	if(!$fp) {
	$Info['online'] = false;
	} else {
	$Info['online'] = true;
	}
	if($Info['online'] == false) {
	} else {
	$ping = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
	$Info['ping'] = $ping * 1000;
	$version = $Info['version']['name'];
	$Info['version'] = $version;
	if(!empty($Info['players']['sample'])) {
    $Info['pnames'] = $Info['players']['sample'];
	} else {
	$Info['pnames'] = false;
	}
	$players = $Info['players'];
	$Info['players'] = $players['online'];
	$Info['maxplayers'] = $players['max'];
	$rawmotd = utf8_decode($Info['description']);
	$Info['motd_raw'] = $rawmotd;
	$motd = $Info['description'];
	$motd = preg_replace("/(§.)/", "", $motd);
    $motd = preg_replace("/[^[:alnum:][:punct:] ]/", "", $motd);
	$Info['motd'] = $motd;
	$color = MineToWeb($Info['description']);
	$color = preg_replace("/[^[:alnum:][:punct:] ]/", "", $color);
	$Info['colormotd'] = $color;
	return $Info;
	}
	}
	}
?>
