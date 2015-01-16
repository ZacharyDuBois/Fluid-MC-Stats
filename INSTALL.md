# INSTALL.md

1. First, make a home for where the files will reside. You can read about the base system requirements to run this.
2. Upload the files you the location you just made for them.
3. Load `stats.domain.tld` or `domain.tld/stats` in a browser.
  - If you get read/write errors on the install page, please make sure `config.php` and `tmp/` are writable by the web server.
4. You should be redirected to `stats.domain.tld/pages/install/install.php` or `domain.tld/stats/pages/install/install.php` if Fluid MC Stats detected the correct location. You may navigate there if you were not redirected.
5. Fill out all the options, all of the items listed will change the way the interface will function.
6. Once all the required settings are filled out, click install.
  - For the `Base URL`, if you installed Fluid MC Stats into a subdomain, this should be left blank. But if you installed it into a subdirectory (`domain.tld/stats/`), set this to the request URI to the Fluid MC Stats installation. In most cases, it is able to pre-fill that value. In the example case, it would be `stats/`.
7. Delete `pages/install/` to finalize the installation.
8. You now have a working install :)
