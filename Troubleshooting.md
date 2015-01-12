# TROUBLESHOOTING.md

PLEASE: Go through this file *before* opening an issue about it.

### Division by zero

- Do you have any players in your database? If you don’t there is where the zero is coming from! Make sure people have the permissions to be tracked by Stats!

### Fetch_array Errors

- Are you using the latest version of Stats? You must use the new database format for the interface to work.

### Why are online player's faces being shown?

This could be because of the lack of support for `MinecraftQuery.php`. If you have not already disabled this in your config, you should see the following error where the online faces should be:

    Oh no! MinecraftQuery.php cannot query your server. If you find this as an error, open an issue on GitHub. Otherwise, edit the config value $hide_limited_feature_warning to true.

If this happens, you should follow what it says and it will go away. But if you think this is an error, please open an issue.

### I am somewhat knowledgeable, how can I self-debug?

Edit the config to `$debug=true;` and it will display all the debug information. Most of the data is self-explanatory, but don't hesitate to ask in an issue.

### Why does my server always appear offline?

Turn on your server query in your `server.properties` file.

### Why is the ping time sometime shown and sometimes not.

Normally when you are hosting the interface on the same server as your Minecraft server, the query times are very fast and therefore inaccurate to your users. 

### Other

- We currently are no longer supporting Fluid MC Stats v0.1.X because of the new version we are working on. Please make sure everything you have is setup correctly.
- We will not support users who are tying to host this locally as it causes many issues that we cannot reproduce to fix. Please host this on a server made for PHP.