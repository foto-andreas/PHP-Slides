# PHP-Slides
Dynamic Image Slide View

* clone the repo
* Make the folder name a nice name for your image set
* add jpg-files in the directory
* add a "thumbs" directory and create thumbnails using imagemagick with 
```bash
for i in *.jpg; do 
  convert -geometry 250x250 $i thumbs/$i
done
```
* browse to the image folder url
