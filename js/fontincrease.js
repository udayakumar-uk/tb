 $(document).ready(function() {

                                $('#incfont').click(function(){        

        curSize= parseInt($('#text-resize').css('font-size')) + 1;

                                if(curSize<=16)

        $('#text-resize').css('font-size', curSize);

        }); 

                                $('#decfont').click(function(){      

        curSize= parseInt($('#text-resize').css('font-size')) - 1;

                                if(curSize>=10)

        $('#text-resize').css('font-size', curSize);

        });
$('#norfont').click(function(){
     curSize1= parseInt($('#text-resize').css('font-size', ''))  ;
        $('#text-resize').css('font-size', curSize1);
        });
                });