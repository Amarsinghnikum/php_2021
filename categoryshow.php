
<?php
session_start();
include_once "management/includes/pro_api_db.php";
$commonFunObj = new CommonFunctions();
$getCategory = $commonFunObj->getList("category");
?>
<script>
	function editCategory(cid){
		var category_id = cid;
		alert(category_id);
	}
	function statusChange(cid){
		var category_id = cid;
		 parameters = "category_id="+category_id+"&action=categoryStatus";
		$.ajax({  
	          type: "POST",  
	          url: "ajax_status.php", 
	          data: parameters,
	          success: function(response){
	          	//alert(response);
	            if(response == "succ"){
	              showDataC();
	              $('#category').val("");
	              document.getElementById("msg").innerHTML="Update category status successfull..."; 
	            }
	           
	          }
        });
	}
	function deleteCategory(cid){
		alert("Are you sure delete category.");
		var category_id = cid;
		 var parameters = "";
	        parameters = "category_id="+category_id+"&action=categoryDel";
	        //alert(parameters);
	        $.ajax({  
	          type: "POST",  
	          url: "ajax_delete.php", 
	          data: parameters,
	          success: function(response){
	          	//alert(response);
	            if(response == "succ"){
	              showDataC();
	              $('#category').val("");
	              document.getElementById("msg").innerHTML="Delete category successfull..."; 
	            }
	           
	          }
        });
	}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admintable">
    <tr>
      <th width="59" align="left" valign="middle">Sr.No.</th>
      <th width="752" align="left" valign="middle">Category Name</th>
      <th width="77" align="left" valign="middle">Status</th>
      <th width="54" align="left" valign="middle">Edit</th>
      <th width="71" align="left" valign="middle">Remove</th>
    </tr>
<?php
if($getCategory>0){
	$sn= 1;
	foreach($getCategory as $showCategory){
		$categoryId = $showCategory['id'];
		if($showCategory['display_status']==1){
				$status = "Active";
		}else if($showCategory['display_status']==0){
				$status = "Deactive";
		}
		?>
		 <tr>
		      <td align="left" valign="top"><?=$sn?></td>
		      <td align="left" valign="top"><?=$showCategory['category_name']?></td>
		      <td align="left" valign="top" onclick="statusChange(<?=$categoryId?>)"><strong><?=$status?></strong></td>
		      <td align="left" valign="top"><a href="edit_category.php?cid=<?=$categoryId?>">Edit</a></td>
		      <td align="center" valign="top" onclick="deleteCategory(<?=$categoryId?>)"><a href="#"><img src="images/icon-bin.jpg" alt="" width="25" height="25" border="0" align="absmiddle" /></a></td>
	    </tr>
		<?php
		$sn++;
	}
}

?>
</table>