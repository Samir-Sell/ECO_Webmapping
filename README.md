# Eco_Webmapping

This is a webmap I created for a school project. The webmap uses a fragment of wild life value sites which were downloaded from the [Governement of Ontario GeoHub](https://geohub.lio.gov.on.ca/datasets/wildlife-values-site/geoservice). The sites are all represented as point data with the majority of sites being important nesting areas. I  documented my thought processes, the tools I used, and the issues I ran into. You can watch a quick demo of the web app [here](https://imgur.com/a/wi1l73x) or you can use the final web map application which can be found [here.](http://178.128.231.160/)

Data Snippet:
![](https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/Data.PNG)



A visualization of the workflow can be seen below: 


![](https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/Webmap_App%20(2).png)

---

## Set up and Testing

I first had to learn the very basics of Javascript. I used a free [Udacity course](https://www.udacity.com/course/intro-to-javascript--ud803) to pick up the basics and learn syntax. I also had to learn the basics of HTML and CSS which I learned from vairous Youtube tutorials. In addition, in order to execute code server side, I had to learn the very basics of PHP which I also learned from Youtube tutorials and by studying the official PHP website. Finally, I learned the JS mapping framework called Leaflet which allows for the creation of light weight web maps. Lastly, there was a lot of Googling specific problems that inevitably ocurred while I was actively creating the web map.

I decided on mapping the wild life value sites as I wanted the map to be relavant to my environmental science roots. I wanted to develop something that someone in the field could use to look for important nesting sites. The first step was to download XAAMP and begin developing the basic HTML and CSS files within the htdocs folder of XAAMP. From there, I was able to run an apache server using XAAMP to view my website on localhost. I then had to install PHP on XAAMP in order to communicate between my server and the users machine. Originally, I ran into an issue where I could not access a specific PHP module which would allow me to send HTTP POST requests in order to communicate back and fourth from my server. To fix this, I discovered I had to go into my PHP configuration files within XAAMP and uncomment the PostgreSQL PDO module which then allowed for my PHP script to work. 

I was now able to implement my first button which allowed users to load nesting sites that were within their current view frame. I was able to do this by using a Leaflet method to return the coordinate bounds of the users current view field. I was then able to parse through the bounds to return the required information that would need to be entered into an SQL query to return the data. I used AJAX to action a POST request which sent my view frame extent to my server and called a script I created named load_data.php. Before I get into the specifics of the load_data.php script, PostgreSQL and PostGIS will need to be discussed. 

Load Data Button:

![](https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/Load_Data.PNG)

I installed PostgreSQL with the PostGIS extension. I had then loaded in a fragment of data from the wild life value sites data set. This data set was loaded into postgreSQL by using ogr2ogr which allowed me to load shapefiles into the database. The load_data.php script used the PHP PDO data object to connect to my Postgres database and execute a query. The query would select geometries from my database that were within the bounding box paramters gathered from the user. Additionally, I chose to select the records as JSON. The returned selection was assigned to a variable and looped through in order to convert the JSON to a GeoJSON format that was readable by Leaflet.JS. All records were then combined into a single GeoJSON file which was then returned to the user. Additionally, the GeoJSON text was written into a GeoJSON file locally on the server and stored there. If one already existed, the new file would replace the old one. This will lead us into the next functon. The user has the ability to download the currently displayed GeoJSON data that they have just generated. 

Download Data Button:

![](https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/Download_Data.PNG)

GeoJSON Output Snippet:

![](https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/GeoJSON.PNG)

Another useful functionality was added to the web map by using a Leaflet community add on called Leaflet.Draw. This add on allows the implementation of a control panel that allows the user to draw various shapes. In my case, I only wanted rectangles to be drawn so I disabled all other shapes besides rectangles. The rectangle acts as a bounding box tool that allows users to draw a rectangle in order to query for nest data from the database. I was able to access the latitude and longitude data from the created bounding box in order to parse the needed parameters for the SQL query that was located in my load_data.php script. Therefore, I was able to use a POST request to send the parameters to the server side script and return GeoJSON from the database to the user.

![](https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/Bounding_Box.png)


Finally, I added some quality of life additions to the map such as text updating on mouse movement that informs the user of their cursors current latitude, longitude and zoom level. This was implemented by using https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/Bounding_Box.pngbuilt in Leaflet.JS functions. Additionally, I allowed the user to click on popups on the map in order to find out what kind of nest it was. This was completed by parsing the the current GeoJSON to pull out the attribute I wanted to display and then displaying it using a Leaflet method. 

![](https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/popup.PNG)

## Server Set Up

The next step in the process was to set up a server which would be able to serve my data through a webserver. The server used was an Ubuntu Linux VM Droplet from Digital Ocean. On the VM, I installed and confugred Apache using one of the many different apache tutorials. Just like XAAMP, I had to install PHP and enable the PostgreSQL PDO module in the PHP Apache configuration file. I also had to install PostgreSQL on the VM, along with its postGIS extension. I tried to load my data into PostgreSQL directly from a wget call using the Government of Ontario API. However, I ran into security issues and limitations which prevented me from successfully downloading the required data. Instead, I used a program called Filezilla to use FTP protocol to transfer the files directly from my local machine to the VM. I then used ogr2ogr on the VM to load the data into my database table. From there, I set up the required file structure of my website by following online tutorials and permitted it to go live. 

## Challenges

By far the biggest challenges I ran into were scope creep and the abundance of technologies I had to learn in order to finish this project. Originally, I had dreams of adding more features. However, I believe I would have needed a lot more time to spend on this project without interuptions from jobs and other courses. Furthermore, the amount of technologies that were required to allow this webmap to work kept growing and I found it difficult to remember everything I had learned when I took a break from the project. I never realized how many pieces of software I would have to implement in order to have a functional webmap. Much of the software I used was older software such as AJAX. I made this choice as there were numerous tutorials and documentation I could pull from in order to develop the webmap. The newer snazzier software did not have as many Geo related tutorials. 

## Wrap-up

Altogether this was an enjoyable project that greatly increased my knowledge of how webmaps functions. I was able to learn the basics of many different types of useful technologies. These basics will provide a jump off point for my next project I decide to undertake. I look forward to continuing my learning so that I can eventually create full fledged web map applications for end users. The whole web applications appears as such:

![](https://github.com/Samir-Sell/Eco_Webmapping/blob/Eco_Webmapping/Images/Overview.PNG)

