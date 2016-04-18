# Error Codes

## 1: Failed to require file `file name`.

### Location

This error is located in `fmcs/inc/Load.php#36`.

### Description / Reason

This exception triggers when there is an issue either loading or determining the type of what to require.

### Resolution

Check the paths located in the array `$load` in  `fmcs/inc/Load.php#13` for any extraneous files. This means files
that are not in the original copy, any non-PHP files, or alike.

TODO: Make a generator for this.