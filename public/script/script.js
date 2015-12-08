// Slideshow home

$(document).ready(function() {
 
  var time = 7; // time in seconds
 
  var $progressBar,
      $bar, 
      $elem, 
      isPause, 
      tick,
      percentTime;
 
    //Init the carousel
    $("#owl-demo").owlCarousel({
      slideSpeed : 10000,
      paginationSpeed : 10000,      
      singleItem : true,
      transitionStyle : "fade",
      afterInit : progressBar,
      afterMove : moved,
      startDragging : pauseOnDragging
    });
 
    //Init progressBar where elem is $("#owl-demo")
    function progressBar(elem){
      $elem = elem;
      //build progress bar elements
      buildProgressBar();
      //start counting
      start();
    }
 
    //create div#progressBar and div#bar then prepend to $("#owl-demo")
    function buildProgressBar(){
      $progressBar = $("<div>",{
        id:"progressBar"
      });
      $bar = $("<div>",{
        id:"bar"
      });
      $progressBar.append($bar).prependTo($elem);
    }
 
    function start() {
      //reset timer
      percentTime = 0;
      isPause = false;
      //run interval every 0.01 second
      tick = setInterval(interval, 10);
    };
 
    function interval() {
      if(isPause === false){
        percentTime += 1 / time;
        $bar.css({
           width: percentTime+"%"
         });
        //if percentTime is equal or greater than 100
        if(percentTime >= 100){
          //slide to next item 
          $elem.trigger('owl.next')
        }
      }
    }
 
    //pause while dragging 
    function pauseOnDragging(){
      isPause = true;
    }
 
    //moved callback
    function moved(){
      //clear interval
      clearTimeout(tick);
      //start again
      start();
    }
 
    //uncomment this to make pause on mouseover 
    // $elem.on('mouseover',function(){
    //   isPause = true;
    // })
    // $elem.on('mouseout',function(){
    //   isPause = false;
    // })
 
})

// Slideshow category

$(document).ready(function() {
     
      //Sort random function
      function random(owlSelector){
        owlSelector.children().sort(function(){
            return Math.round(Math.random()) - 0.5;
        }).each(function(){
          $(this).appendTo(owlSelector);
        });
      }
     
      $("#owl-demo-category").owlCarousel({ 
        autoPlay : 3000,
        stopOnHover : true,      
        navigation: false,
        navigationText: [
          "<i class='fa fa-chevron-left icon-white'></i>",
          "<i class='fa fa-chevron-right icon-white'></i>"
          ],
        beforeInit : function(elem){
          //Parameter elem pointing to $("#owl-demo")
          random(elem);
        }
     
      });
     
});

// Slideshow product

$(document).ready(function() {
     
      //Sort random function
      function random(owlSelector){
        owlSelector.children().sort(function(){
            return Math.round(Math.random()) - 0.5;
        }).each(function(){
          $(this).appendTo(owlSelector);
        });
      }
     
      $(".owl-demo-product").owlCarousel({
        autoPlay : 3000,
        stopOnHover : true,
        navigation: false,
        navigationText: [
          "<i class='fa fa-chevron-left icon-white'></i>",
          "<i class='fa fa-chevron-right icon-white'></i>"
          ],
        beforeInit : function(elem){
          //Parameter elem pointing to $("#owl-demo")
          random(elem);
        }
     
      });
     
});

$('.datepicker').datepicker()