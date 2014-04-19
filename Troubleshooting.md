# Troubleshooting.md

If you are having problems with Fluid MC Stats, please go though this list before you make a issue about it.

### Devision by zero

- Do you have any players in your database? If you don’t there is where the zero is coming from! Make sure people have the permissions to be tracked by Stats!

### Fetch_array Errors

- Are you using the latest version of Stats? You must use the new database format for the interface to work.

### CSS is not rendering

- Make sure you are serving CSS files on your CDN with the `Content-Type` set to `text/css`.
- Make sure your CDN domain is added to the `crossdomain.xml`.

### Other

- We currently are no longer supporting Fluid MC Stats v0.1.X because of the new version we are working on. Please make sure everything you have is setup correctly.