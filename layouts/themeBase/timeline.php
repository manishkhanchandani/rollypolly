<style type="text/css">
  @import url("//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic");
  @import url("//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
  
  
  .event-list {
  list-style: none;
  font-family: 'Lato', sans-serif;
  margin: 0px;
  padding: 0px;
}
.event-list > li {
  background-color: rgb(255, 255, 255);
  box-shadow: 0px 0px 5px rgb(51, 51, 51);
  box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
  padding: 0px;
  margin: 0px 0px 20px;
}
.event-list > li > time {
  display: inline-block;
  width: 100%;
  color: rgb(255, 255, 255);
  background-color: rgb(197, 44, 102);
  padding: 5px;
  text-align: center;
  text-transform: uppercase;
}
.event-list > li:nth-child(even) > time {
  background-color: rgb(165, 82, 167);
}
.event-list > li > time > span {
  display: none;
}
.event-list > li > time > .day {
  display: block;
  font-size: 50pt;
  font-weight: 100;
  line-height: 1;
}
.event-list > li time > .month {
  display: block;
  font-size: 20pt;
  font-weight: 900;
  line-height: 1;
}
.event-list > li time > .year {
  display: block;
  font-size: 8pt;
  font-weight: 600;
  line-height: 1;
}
.event-list > li time > .time {
  display: block;
  font-size: 8pt;
  font-weight: 500;
  line-height: 1;
}
.event-list > li > img {
  width: 100%;
}
.event-list > li > .info {
  padding-top: 5px;
  text-align: center;
}
.event-list > li > .info > .title {
  font-size: 17pt;
  font-weight: 700;
  margin: 0px;
}
.event-list > li > .info > .desc {
  font-size: 13pt;
  font-weight: 300;
  margin: 0px;
}
.event-list > li > .info > ul,
.event-list > li > .social > ul {
  display: table;
  list-style: none;
  margin: 10px 0px 0px;
  padding: 0px;
  width: 100%;
  text-align: center;
}
.event-list > li > .social > ul {
  margin: 0px;
}
.event-list > li > .info > ul > li,
.event-list > li > .social > ul > li {
  display: table-cell;
  cursor: pointer;
  color: rgb(30, 30, 30);
  font-size: 11pt;
  font-weight: 300;
      padding: 3px 0px;
}
  .event-list > li > .info > ul > li > a {
  display: block;
  width: 100%;
  color: rgb(30, 30, 30);
  text-decoration: none;
} 
  .event-list > li > .social > ul > li {    
      padding: 0px;
  }
  .event-list > li > .social > ul > li > a {
      padding: 3px 0px;
} 
.event-list > li > .info > ul > li:hover,
.event-list > li > .social > ul > li:hover {
  color: rgb(30, 30, 30);
  background-color: rgb(200, 200, 200);
}
.facebook a,
.twitter a,
.google-plus a {
  display: block;
  width: 100%;
  color: rgb(75, 110, 168) !important;
}
.twitter a {
  color: rgb(79, 213, 248) !important;
}
.google-plus a {
  color: rgb(221, 75, 57) !important;
}
.facebook:hover a {
  color: rgb(255, 255, 255) !important;
  background-color: rgb(75, 110, 168) !important;
}
.twitter:hover a {
  color: rgb(255, 255, 255) !important;
  background-color: rgb(79, 213, 248) !important;
}
.google-plus:hover a {
  color: rgb(255, 255, 255) !important;
  background-color: rgb(221, 75, 57) !important;
}

@media (min-width: 768px) {
  .event-list > li {
    position: relative;
    display: block;
    width: 100%;
    height: 120px;
    padding: 0px;
  }
  .event-list > li > time,
  .event-list > li > img  {
    display: inline-block;
  }
  .event-list > li > time,
  .event-list > li > img {
    width: 120px;
    float: left;
  }
  .event-list > li > .info {
    background-color: rgb(245, 245, 245);
    overflow: hidden;
  }
  .event-list > li > time,
  .event-list > li > img {
    width: 120px;
    height: 120px;
    padding: 0px;
    margin: 0px;
  }
  .event-list > li > .info {
    position: relative;
    height: 120px;
    text-align: left;
    padding-right: 40px;
  }	
  .event-list > li > .info > .title, 
  .event-list > li > .info > .desc {
    padding: 0px 10px;
  }
  .event-list > li > .info > ul {
    position: absolute;
    left: 0px;
    bottom: 0px;
  }
  .event-list > li > .social {
    position: absolute;
    top: 0px;
    right: 0px;
    display: block;
    width: 40px;
  }
      .event-list > li > .social > ul {
          border-left: 1px solid rgb(230, 230, 230);
      }
  .event-list > li > .social > ul > li {			
    display: block;
          padding: 0px;
  }
  .event-list > li > .social > ul > li > a {
    display: block;
    width: 40px;
    padding: 10px 0px 9px;
  }
}
</style>
<div id="mapCanvas"></div>
<div class="container-fluid" id="main">
  <div class="row">
    <div class="col-xs-4" id="leftsidebar"><!--map-canvas will be postioned here--></div>
    <div class="col-xs-6" id="middle">
    <?php echo $contentForTemplate; ?>
    </div>
    <div class="col-xs-2" id="right">
      <br />
      <div class="panel panel-primary">
        <div class="panel-heading">Search City</div>
        <div class="panel-body">
          <?php include(SITEDIR.'/locations/searchcity.php'); ?>
        </div>
      </div>
      <?php if (!empty($pageDynamicNavigationItem)) { ?>
      <div class="panel panel-primary">
        <div class="panel-heading">Information</div>
        <div class="panel-body">
          <?php echo $pageDynamicNavigationItem; ?>
        </div>
      </div>
      <?php } ?>
      
      <?php if (!empty($pageDynamicNearby)) { ?>
      <div class="panel panel-primary">
        <div class="panel-heading">Nearby Cities</div>
        <div class="panel-body">
          <?php echo $pageDynamicNearby; ?>
        </div>
      </div>
      <?php } else { ?>
      
        <div id="homepagenearby" style="display:none;" class="panel panel-primary">
          <div class="panel-heading">Nearby Cities</div>
          <div class="panel-body" id="homepagenearbycontent">
            
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>