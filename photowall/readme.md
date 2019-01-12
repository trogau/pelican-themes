# Photowall

A very basic theme for Pelican for a simple image wall front page. 

# Requirements

- the 'neighbours' plugin (for next/previous photo)
- markdown for Python (pip install markdown)

## Usage

1. Find your Pelican content directory. I keep mine in /www/photos/html/content
2. Copy your image into the content directory. 
3. Create a 300x300 thumbnail of the image and copy it into the content directory.
4. Create a .md for the image in the content directory. It should look something like: 
  ```
  Title: Banff, Canada
  Date: 2015-01-24 18:13
  Category: Photo
  Thumbnail: TN_banff.jpg

  [![Foo]({attach}images/banff.jpg)]({filename})
  [![Foo]({attach}images/TN_banff.jpg)]({filename})
  ```
5. Put the .md file into the content directory. 
6. Run `pelican content` to generate the HTML.
7. This should be it - check your output directory for the HTML. 

## Contact

Twitter: @trawg
