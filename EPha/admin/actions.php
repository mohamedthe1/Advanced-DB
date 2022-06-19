<?php

session_start();

$navbar = true;

require_once "core/init.php";
$admin = new Admin();
if(!$admin->IsLoggedIn())
{
	Redirect::to("login.php");
}

else
{
?>

<div class="container">

<?php
	if(Input::exists("GET") || Input::exists("POST"))
	{
		$tabel = Input::get("tab","GET");
		$action = Input::get("action","GET");

		if($action === "add")
		{
			$data = $_POST;
			$imageName       = $_FILES['image']['name'];
            $imageType       = $_FILES['image']['type'];
            $imageTmpName    = $_FILES['image']['tmp_name'];
			$imageSize       = $_FILES['image'] ['size'];
			$imageAllowedExtensions  = array("jpeg","jpg","png","gif");
			$imageExtensions = strtolower(end(explode(".", $imageName)));
			$image = rand() . "_" . $imageName;
			move_uploaded_file($imageTmpName, "uploads\medicines\\" . $image);
			$data['image'] = $image;
			$db = new DB();
			if($tabel === "medicine")
			{
				$db->getAllFrom("*",$tabel,"WHERE BatchNo = ? OR Name = ? AND CatName = ?" ,array($data['BatchNo'],$data['Name'],$data['CatName']));
				if($db->getCount() == 0)
				{
					if($db->insertIn($tabel,$data))
					{
						echo "<div class='alert alert-success'>Successfully Added</div>";
						Redirect::to("medicine.php?action=add");
					}
					else
					{
						echo "<div class='alert alert-danger'>Error In Inserting Operation</div>";
						Redirect::to("medicine.php?action=add");
					}
				}

				else
				{
					echo "<div class='alert alert-danger'>This Medicine Exists In The Category</div>";
					Redirect::to("medicine.php?action=add");
				}

			}
			else if($tabel === "categories")
			{
				$db->getAllFrom("*",$tabel,"WHERE ID = ? OR Name = ?" ,array($data['ID'],$data['Name']));
				if($db->getCount() == 0)
				{
					if($db->insertIn($tabel,$data))
					{
						echo "<div class='alert alert-success'>Successfully Added</div>";
						Redirect::to("categories.php?action=manage");
					}
					else
					{
						echo "<div class='alert alert-danger'>Error In Inserting Operation</div>";
						Redirect::to("categories.php?action=add");
					}
				}

				else
				{
					echo "<div class='alert alert-danger'>This Category Is Exists</div>";
					Redirect::to("categories.php?action=add");
				}
			}
			else if($tabel === "admins")
			{
				$salt = Hash::makeSalt();
				$data['Password'] = Hash::makeHash($data['Password'],$salt);
				$data['salt'] = $salt;
				$db->getAllFrom("*",$tabel,"WHERE Username = ?" ,array($data['Username']));
				if($db->getCount() == 0)
				{
					if($db->insertIn($tabel,$data))
					{
						echo "<div class='alert alert-success'>Successfully Added</div>";
						Redirect::to("members.php?action=manage");
					}
					else
					{
						echo "<div class='alert alert-danger'>Error In Inserting Operation</div>";
						Redirect::to("members.php?action=add");
					}
				}

				else
				{
					echo "<div class='alert alert-danger'>This Member Is Exists</div>";
					Redirect::to("members.php?action=add");
				}
			}
		}



		else if($action === "delete")
		{

			$db = new DB();
			if($tabel === "medicine")
			{
				if($db->deleteFrom("{$tabel}","WHERE BatchNo = ?",array(Input::get("batchno","GET"))))
				{
					echo "<div class='alert alert-danger'>Successfully Deleted</div>";
					Redirect::to("medicine.php?action=manage");
				}
				else
				{
					echo "<div class='alert alert-danger'>Error In Deleting Operation</div>";
					Redirect::to("medicine.php?action=manage");
				}
			}
			else if($tabel === "categories")
			{
				if($db->deleteFrom("{$tabel}","WHERE ID = ?",array(Input::get("id","GET"))))
				{
					echo "<div class='alert alert-danger'>Successfully Deleted</div>";
					Redirect::to("categories.php?action=manage");
				}
				else
				{
					echo "<div class='alert alert-danger'>Error In Deleting Operation</div>";
					Redirect::to("categories.php?action=manage");
				}
			}
			else if($tabel === "admins")
			{
				if($db->deleteFrom("{$tabel}","WHERE ID = ?",array(Input::get("id","GET"))))
				{
					echo "<div class='alert alert-danger'>Successfully Deleted</div>";
					Redirect::to("members.php?action=manage");
				}
				else
				{
					echo "<div class='alert alert-danger'>Error In Deleting Operation</div>";
					Redirect::to("members.php?action=manage");
				}
			}

		}
		else if($action === "update")
		{
			$db = new DB();
			$data = $_POST;
			
			

			if($tabel === "medicine")
			{

				if($_FILES['image']['name'] != NULL) {
					$imageName       = $_FILES['image']['name'];
					$imageType       = $_FILES['image']['type'];
					$imageTmpName    = $_FILES['image']['tmp_name'];
					$imageSize       = $_FILES['image'] ['size'];
					$imageAllowedExtensions  = array("jpeg","jpg","png","gif");
					$imageExtensions = strtolower(end(explode(".", $imageName)));
					$image = rand() . "_" . $imageName;
					move_uploaded_file($imageTmpName, "uploads\medicines\\" . $image);
					$data['image'] = $image;
					
				}

				$db->getAllFrom("*",$tabel,"WHERE BatchNo = ? AND Name = ?" ,array($data['BatchNo'],$data['Name']));

				if($db->getCount() == 0)
				{
					if($db->updateTable($tabel,"WHERE BatchNo = " . Input::get('batchno','GET'),$data))
					{
						echo "<div class='alert alert-success'>Successfully Updated</div>";
						Redirect::to("medicine.php?action=manage");
					}
					else
					{
						echo "<div class='alert alert-danger'>Error In Updating Operation</div>";
						Redirect::to("medicine.php?action=manage");
					}
				}
				else
				{
					if(
						$db->deleteFrom($tabel,"WHERE BatchNo = ? AND Name = ?",array($data['BatchNo'],$data['Name']))
						&&
						$db->insertIn($tabel,$data)
					)
					{
						echo "<div class='alert alert-success'>Successfully Updated</div>";
						Redirect::to("medicine.php?action=manage");
					}
				}
			}

			else if($tabel === "categories")
			{
				$db->getAllFrom("*",$tabel,"WHERE ID = ? AND Name = ?" ,array($data['ID'],$data['Name']));

				if($db->getCount() == 0)
				{
					if($db->updateTable($tabel,"WHERE ID = " . Input::get('id','GET'),$data))
					{
						echo "<div class='alert alert-success'>Successfully Updated</div>";
						Redirect::to("categories.php?action=manage");
					}
					else
					{
						echo "<div class='alert alert-danger'>Error In Updating Operation</div>";
						Redirect::to("categories.php?action=manage");
					}
				}

				else
				{
					$med = new DB();
					$med->getAllFrom("*","medicine","WHERE CatName = ?",array(Input::get('name','GET')));
					$meds = NULL;
					$x = 0;
					if($med->getCount() > 0)
					{
						foreach ($med->getResult() as $result) {
							$meds[$x]['Name']			= $result['Name'];
							$meds[$x]['BatchNo']		= $result['BatchNo'];
							$meds[$x]['SalesPrice']		= $result['SalesPrice'];
							$meds[$x]['PurchasePrice']	= $result['PurchasePrice'];
							$meds[$x]['CatName']		= $result['CatName'];
							$meds[$x]['PurchasePrice']	= $result['PurchasePrice'];
							$meds[$x]['CatName']		= $result['CatName'];
							$meds[$x]['Quantity']		= $result['Quantity'];
							$x++;
						}

					}
					$db->deleteFrom($tabel,"WHERE Name = ?",array(Input::get('name','GET')));
					$db->insertIn($tabel,$data);

					if(count($meds))
						for($y=0 ; $y < $x ; $y++)
						{
							$med->insertIn("medicine",$meds[$y]);
						}

					echo "<div class='alert alert-success'>Successfully Updated</div>";
					Redirect::to("categories.php?action=manage");


				}
			}




		}
		else if($action === "approveorder")
		{
			$db = new DB();
			if($db->updateTable("customers","WHERE ID = " . Input::get("id","GET"),array("Approve" => 1)))
			{
				echo "<div class='alert alert-success'>Approved Successfully</div>";
				Redirect::to("index.php");

			}
			else
			{
				echo "<div class='alert alert-danger'>Error In Approved Operation</div>";
				Redirect::to("index.php");
			}
		}




	}


}

?>

</div>

<?php


require_once $tempRoute . "footer.php";
