<?php
       session_start();
       $ID=$_SESSION['ID']; 
       include('abcd.php');
       if(isset($_GET['q'])){

                   
        $name=$_GET['q'];
        $a[0]=" ";
        $a[1]=" ";
        $a=explode(" ",$name);
        $fname=$a[0];
        $lname="";
        if(isset($a[1])){
            $lname=$a[1];
        }
        $query="SELECT ID,fname,lname FROM logindetails WHERE fname LIKE'$fname%'AND lname LIKE '$lname%' ";
        $run=mysqli_query($con,$query);
        while($data=mysqli_fetch_assoc($run)){
            
              
                $buddyID=$data['ID'];
                $query1="SELECT ID2 FROM buddylist WHERE ID1=$ID AND ID2=$buddyID";
                $run1=mysqli_query($con,$query1);
                $data1=mysqli_fetch_assoc($run1);
      
                if($data1!=NULL){
                  echo '<h5>*<a href="profile.php?ID='.$data['ID'].'">'.$data['fname'].' '.$data['lname'].'</a><h6><center>You both are already buddy</center></h6>';
                }
                else{
                    if($data['ID']!=$ID){
                        echo '<h5>*<a href="profile.php?ID='.$data['ID'].'">'.$data['fname'].' '.$data['lname'].'</a> <a href="sendrequest.php?ID='.$data['ID'].'"><button style="background-color:#138963; color: white; border-radius: 8px;">Send Request</button></a></h5>';  
                     }
                      }
                
              ?>
              <hr>
              <?php
        }
        
        
       
        
       }



?>