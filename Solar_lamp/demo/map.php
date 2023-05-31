<!DOCTYPE HTML>
<html>
  <head>
        <meta charset="UTF-8">
        <title>Create Map Sample | Longdo Map</title>
        <style type="text/css">
html {
  height: 100%;
}
body {
  margin: 0px;
  height: 100%;
}
#map {
  height: 100%;
}
</style>
        <script type="text/javascript" src="https://api.longdo.com/map/?key=0c0aaa7222430d95e44fcf93a7fe68b5"></script>
        <script>
        var marker = new longdo.Marker({ lon: 100.48189769999999, lat: 7.0100058 },
        {
            title :"device1",
            detail : "อยู่ตรงนี้นานๆได้มั้ย อย่างพึงหนีไปให้ฉัน..... by เดย์บางทราย"
        }
        );
        var marker2 = new longdo.Marker({ lon: 100.48189769999999, lat: 7.02 },
        {
            title :"device2",
            detail : "รักไม่ได้ช่วยให้ลืม อิ้ง"
        }
        );
        
          function init() {
            var map = new longdo.Map({
              placeholder: document.getElementById('map'),
              zoom:15,
              lastView: false,
              location: {
                  lat: 7.0100058,
                  lon: 100.48189769999999
              }
              
            });
            map.Layers.setBase(longdo.Layers.GRAY);
            map.Overlays.add(marker);
            map.Overlays.add(marker2);
          }
        </script>
  </head>
  <body onload="init();">
      <div id="map"></div>
  </body>
</html>