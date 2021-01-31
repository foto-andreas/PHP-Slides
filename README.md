# PHP-Slides
Dynamic Image Slide View

* clone the repo
* Make the folder name a nice name for your image set
* add jpg- and mp4-files in the directory
* add a "thumbs" directory and create thumbnails using imagemagick with
```bash
mkthumbs.sh [--replace]
```
* if you give `--replace` all thumbs are recreated, otherwise thumbs are created only for new files
* browse to the image folder url
