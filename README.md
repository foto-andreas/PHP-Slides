# PHP-Slides
Dynamic Image Slide View

* clone the repo
* add jpg-files in the directory
* add a "thumbs" directory and create thumbnails using imagemagick with 
<code>
for i in *.jpg; do 
  convert -geometry 250x250 $i thumbs/$i
done
</code>
