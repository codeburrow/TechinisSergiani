//noConflict is used to avoid errors that occur when using anonymous functions in jquery
$.noConflict();

jQuery( document ).ready(function($) {

    $(function() {
        //both ul (gallery and carousel) are assigned the sortable functionality
        $( "#gallery, #carousel" ).sortable({
            //connectWith allows both ul to get connected to be able to drag li from one to the other. If they are not connected you would only be able to sort li within their parent ul and not added to a different ul
            connectWith: ".connectedSortable"
        }).disableSelection();
    });

    var image = "";

    // .droppable makes the element accept other draggable elements
    $( ".icon" ).droppable({
        // the code below defines what happens to any element when its placed over the droppable
        //example animation
        over: function(event, ui) {
            image = ui.draggable;
            $(".icon").css("box-shadow", "0 0 7px rgba(10,10,10,.3)");
            $(".lid ").css("transform", "rotate(10deg)");
            $(".lidcap").css("transform", "rotate(10deg)");
            $(".icon .lid .lidcap").css("margin-bottom", "10.5px");
            $(".lid").css("margin-bottom", "10.5px");
            $(".lidcap").css("margin-bottom", "10.5px");
            $(image).css("opacity", "0.2");
        }
    });

    $( ".icon" ).droppable({
        // the code below defines what happens to any element when its dragged out of the droppable
        //example reverse-animation
        out: function() {
            $(".icon").css("box-shadow", "0");
            $(".lid ").css("transform", "rotate(0deg)");
            $(".lidcap").css("transform", "rotate(0deg)");
            $(".icon .lid .lidcap").css("margin-bottom", "0px");
            $(".lid").css("margin-bottom", "0px");
            $(".lidcap").css("margin-bottom", "0px");
            $(image).css("opacity", "1");

        }
    });

    $( ".icon" ).droppable({
        // the code below defines what happens to any element when its dropped on the droppable
        //example execution of actions and animation
        drop: function(event, ui) {

            var id = $( ui.draggable).children().attr("id");
            var path = $( ui.draggable).children().attr("src");
            console.log('ID: ' + id);
            console.log('Path: ' + path);

            // detecting whether the user chose to proceed or not
            if(confirm("Are you sure you want to delete this image permanently?")) {

                $.ajax({
                    type: "GET",
                    url: '/deleteFromCarouselDB',
                    data: {
                        ID: id,
                        path: path
                    },
                    success: function(msg){
                        console.log('Success Message: ' + msg);
                    }
                });

                $( ui.draggable).children().addClass("removed-item");

                $(".icon").css("box-shadow", "0");
                $(".lid ").css("transform", "rotate(0deg)");
                $(".lidcap").css("transform", "rotate(0deg)");
                $(".icon .lid .lidcap").css("margin-bottom", "0px");
                $(".lid").css("margin-bottom", "0px");
                $(".lidcap").css("margin-bottom", "0px");
                $(ui.draggable).css("opacity", "1");
                $(ui.draggable).cancel();
            } else {
                $(".icon").css("box-shadow", "0");
                $(".lid ").css("transform", "rotate(0deg)");
                $(".lidcap").css("transform", "rotate(0deg)");
                $(".icon .lid .lidcap").css("margin-bottom", "0px");
                $(".lid").css("margin-bottom", "0px");
                $(".lidcap").css("margin-bottom", "0px");
                $(ui.draggable).css("opacity", "1");
                location.reload();
                ui.draggable.cancel();
            }
        }
    });

});





