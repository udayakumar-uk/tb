<?php 
ob_start();
@session_start();
include "include/include.php";
$selcont=executework("select * from tob_cms where pageid=83");
$rowc=@mysqli_fetch_array($selcont);?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Help | Tobacco Board</title>
  
  <?php include "head.php"; ?>
</head>
<body>

<?php include "tb_header.php"; ?>

<!--------------Content--------------->
<div id="main-content">
  <div id="content" class="container">

    <p>This website includes some content that is available in non-HTML format. They might not be visible properly if your browser does not have     the required plug-ins.<br>
    For example, Acrobat Reader software is required to view Adobe Acrobat PDF files. If you do not have this software installed   on your   computer, you can download it for free. The following table   lists some   plug-ins that you will require:</p>
    
    
    <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <th>Document Type</th>
            <th>Download</th>
          </tr>
          <tr>
            <td>PowerPoint presentation </td>
            <td><a class="text-decoration-underline text-primary" href="http://www.microsoft.com/downloads/details.aspx?FamilyId=428D5727-43AB-4F24-90B7-A94784AF71A4&displaylang=en" target="_blank" title="External Website that opens in a new window"> PowerPoint Viewer 2003 (in any version till 2003)  (External website that opens in a new window)</a></td>
          </tr>
          <tr>
            <td>PDF content</td>
            <td><a class="text-decoration-underline text-primary" href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank" title="External Website that opens in a new window"> Adobe Acrobat Reader  (External website that opens in a new window)</a></td>
          </tr>
          <tr>
            <td>Flash content</td>
            <td><a class="text-decoration-underline text-primary" href="http://get.adobe.com/flashplayer/" target="_blank" title="External Website that opens in a new window"> Adobe Flash Player  (External website that opens in a new window)</a></td>
          </tr>
          <tr>
            <td>Power Point Microsoft Office Open XML<br>
              Format Presentation (PPTX)</td>
            <td><a class="text-decoration-underline text-primary" href="http://www.microsoft.com/downloads/details.aspx?familyid=941b3470-3ae9-4aee-8f43-c6bb74cd1466&displaylang=en" target="_blank" title="External Website that opens in a new window">Microsoft   Office Compatibility Pack for  Word, Excel, and PowerPoint 2007 File   Formats  (External website that opens in a new window)</a></td>
          </tr>
          <tr>
            <td>MPG (video file)</td>
            <td><a class="text-decoration-underline text-primary" href="http://www.microsoft.com/windows/windowsmedia/download/AllDownloads.aspx?displang=en&qstechnology=" target="_blank" title="External Website that opens in a new window"> Windows Media Player </a></td>
          </tr>
        </tbody>
      </table>
  </div>
</div>

<!--------------Footer--------------->
<?php include "tb_footer.php"; ?>

</body>
</html>	