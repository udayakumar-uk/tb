

  $(window).load(function() {
    $(".loginMainCanvas").liquidCanvas(
        "[borderlogin gradient] => roundedRect{radius:15}");
        
    $(".loginMainCanvas2").liquidCanvas(
        "[borderlogin gradient] => roundedRect{radius:15}");
    
    $(".loginMainCanvasShadow").liquidCanvas(
        "[shadowlogin borderlogin gradient] => roundedRect{radius:20}");
        
    $(".loginMainCanvasShadow2").liquidCanvas(
        "[shadowlogin borderlogin gradient] => roundedRect{radius:20}");
        
    $(".noteCanvas").liquidCanvas(
        "[borderwidth1 notegray] => roundedRect{radius:10}");
        
    $(".imageCanvasShadow").liquidCanvas(
        "[shadow borderimage white] => roundedRect{radius:20}");

    $(".canvasShadow").liquidCanvas(
        "[shadow border fill] => roundedRect{radius:20}");
        
    $(".canvasBorder").liquidCanvas(
        "[border gradient] => roundedRect{radius:10}");

    $(".canvasBorderWhite").liquidCanvas(
        "[border white] => roundedRect{radius:10}");
    
    $(".canvasBorderNoColor").liquidCanvas(
        "[border] => roundedRect{radius:10}");
    
  });
