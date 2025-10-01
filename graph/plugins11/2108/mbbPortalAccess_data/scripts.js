
/* toggleLayer */

function toggleLayer( whichLayer )
{
  var elem, vis;
  if( document.getElementById ) // standards
    elem = document.getElementById( whichLayer );
  else if( document.all ) // msie
      elem = document.all[whichLayer];
  else if( document.layers ) // nn4
    elem = document.layers[whichLayer];
  vis = elem.style;
  // style.display value
  if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)
    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';
  vis.display = (vis.display==''||vis.display=='block')?'none':'block';
}