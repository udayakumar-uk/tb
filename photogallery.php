<?php
ob_start();
@session_start();
include "include/include.php";
$seldat=executework("select updated_on from tob_album_title order by updated_on desc limit 1");
$rowd=@mysqli_fetch_array($seldat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Photo Gallery | Tobacco Board</title>
	
	<?php include "head.php"; ?>

	<link rel="stylesheet" href="./fancyapps/fancybox.css"> 

  <style>
    #gallery-items > a{
      height: 200px;
      width: 200px;
      flex-grow: 1;
    }
    #gallery-items > a > img{
      height: 100%;
      width: 100%;
      object-fit: cover;
    }
  </style>
</head>

<body>

<?php include "tb_header.php"; ?>	

<div id="main-content">
  <div id="content" class="container">

    <h1 class="my-4">Photo Gallery</h1>

    <div id="gallery-items" class="d-flex gap-2 flex-wrap mb-4">
      <a href="./img/gallery/gallery-2.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-2.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-3.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-3.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-4.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-4.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-5.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-5.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-6.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-6.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-7.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-7.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-8.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-8.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-9.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-9.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-10.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-10.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-11.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-11.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-12.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-12.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-13.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-13.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-14.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-14.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-15.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-15.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-16.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-16.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-17.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-17.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-18.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-18.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-19.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-19.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-20.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-20.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-21.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-21.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-22.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-22.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-23.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-23.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-24.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-24.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-25.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-25.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-26.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-26.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-27.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-27.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-28.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-28.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-29.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-29.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-30.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-30.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-31.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-31.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-32.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-32.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-33.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-33.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-34.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-34.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-35.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-35.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-36.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-36.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-37.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-37.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-38.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-38.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-39.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-39.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-40.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-40.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-41.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-41.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-42.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-42.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-43.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-43.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-44.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-44.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-45.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-45.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-46.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-46.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-47.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-47.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-48.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-48.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-49.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-49.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-50.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-50.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-51.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-51.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-52.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-52.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-53.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-53.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-54.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-54.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-55.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-55.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-56.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-56.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-57.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-57.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-58.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-58.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-59.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-59.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-60.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-60.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-61.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-61.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-62.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-62.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-63.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-63.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-64.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-64.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-65.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-65.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-66.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-66.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-67.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-67.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-68.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-68.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-69.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-69.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-70.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-70.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-71.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-71.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-72.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-72.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-73.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-73.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-74.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-74.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-75.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-75.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-76.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-76.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-77.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-77.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-78.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-78.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-79.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-79.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-80.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-80.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-81.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-81.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-82.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-82.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-83.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-83.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-84.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-84.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-85.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-85.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-86.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-86.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-87.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-87.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-88.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-88.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-89.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-89.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-90.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-90.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-91.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-91.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-92.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-92.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-93.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-93.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-94.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-94.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-95.jpg" data-fancybox="gallery"> <img src="./img/gallery/gallery-95.jpg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-96.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-96.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-97.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-97.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-98.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-98.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-99.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-99.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-100.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-100.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-101.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-101.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-102.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-102.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-103.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-103.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-104.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-104.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-105.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-105.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-106.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-106.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-107.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-107.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-108.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-108.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-109.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-109.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-110.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-110.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-111.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-111.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-112.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-112.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-113.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-113.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-114.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-114.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-115.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-115.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-116.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-116.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-117.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-117.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-118.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-118.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-119.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-119.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-120.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-120.jpeg" alt="Gallery Image" /></a>
      <a href="./img/gallery/gallery-121.jpeg" data-fancybox="gallery"> <img src="./img/gallery/gallery-121.jpeg" alt="Gallery Image" /></a>
    </div>

    <div class="text-center my-3">
      <button id="load-more-btn" class="btn btn-primary">Load more</button>
    </div>
  
  </div>
</div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

<script src="./fancyapps/fancybox.umd.js"></script>
<script>
  function initFancybox() {
    Fancybox.bind("[data-fancybox]", {
      mainStyle: {
        "--f-toolbar-padding": "16px 32px",
        "--f-toolbar-gap": "8px",
        "--f-button-border-radius": "50%",
        "--f-thumb-width": "82px",
        "--f-thumb-height": "82px",
        "--f-thumb-opacity": "0.5",
        "--f-thumb-hover-opacity": "1",
        "--f-thumb-selected-opacity": "1",
      },
      Carousel: {
        Toolbar: {
          display: {
            right: ["toggleFull", "close"],
          },
        },
      },
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    initFancybox();

    const BATCH = 25;
    const container = document.getElementById('gallery-items');
    if (!container) return;
    const items = Array.from(container.querySelectorAll('a'));

    // Hide everything after the first batch
    items.forEach((el, idx) => {
      if (idx >= BATCH) el.style.display = 'none';
    });

    let current = Math.min(BATCH, items.length);
    const btn = document.getElementById('load-more-btn');
    if (items.length <= BATCH && btn) btn.style.display = 'none';

    function showNextBatch() {
      const next = Math.min(current + BATCH, items.length);
      for (let i = current; i < next; i++) {
        items[i].style.display = '';
      }
      current = next;
      // re-init Fancybox so newly visible items are bound (safe to call multiple times)
      initFancybox();
      if (current >= items.length && btn) btn.style.display = 'none';
    }

    if (btn) btn.addEventListener('click', showNextBatch);
  });
</script>

</body>
</html>