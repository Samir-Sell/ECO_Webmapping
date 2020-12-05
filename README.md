# Eco_Webmapping

This is a webmap I created for a school project. The webmap uses a fragment of wild life value sites which were downloaded from the [Governement of Ontario GeoHub](https://geohub.lio.gov.on.ca/datasets/wildlife-values-site/geoservice). The sites are all represented as point data with the majority of sites being important nesting areas. I will document my thought processes, the tools I used, and this issues I ran into below.

---

## Set up and Testing

I first had to learn the very basics of Javascript. I used a free [Udacity course](https://www.udacity.com/course/intro-to-javascript--ud803) to pick up the basics and learn syntax. I also had to learn the basics of HTML and CSS which I learned from vairous Youtube tutorials. Finally, in order to execute code server side, I had to learn the very basics of PHP which I also learned from Youtube tutorials and by studying the official PHP website. In addition, there was a lot of Googling specific problems that inevitably ocurred while I was actively creating the web map.

I decided on mapping the wild life value sites as I wanted the map to be relavant to my environmental science roots. To develop something that someone in the field can use to look for important nesting sites was a perfect fit. The first step was to download XAAMP and begin developing the basic HTML and CSS files within the htdocs folder of XAAMP. From there, I was able to run an apache server using XAAMP to view my website on localhost. I then had to install PHP on XAAMP in order to communicate between my server and the users machine. Originally, I ran into an issue where I could not access a specific PHP module

