# Packer

User-friendly Box wrapper.

## Steps

### Done

+ Ask for the desired archive name. 
Remove all occurrences of `.phar` in it so that `f("foo") == f("foo.phar")` becomes `true`.

### Yet To Be Done

+ Ask where the binary file is.
Try to guess it using the archive name (search in `bin`, `bins`, `binary` and `binaries`).