<?php 

function show_errors($errors){
  $display = '<ul class="bg-danger">';
  foreach ($errors as $error) {
    $display .='<li class="text-danger">'.$error.'</li>';
    }
    $display .='</ul>';
    return $display;
}
function permission_error_redirect($url = 'login.php'){
  $_SESSION['error_flash'] = 'You don\'t have permission to access that page!';
  header('Location: '.$url);
}

//cleans user input
function clean($dirty){
  return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function smartdate($times){
 return date("M d, Y ",strtotime($times));
}

function login($customer_id){
  $_SESSION['admin'] = $customer_id;
  header('Location: admin/index.php');
}

function is_loggedin(){
  if(isset($_SESSION['admin']) && $_SESSION['admin'] >0){
    return true;
  }
  return false;
}
function login_error_redirect(){
  header('Location: ../login.php');
  $_SESSION['error'] = 'You must be logged in to access that page';
}

function login_customer($data){
  $_SESSION['customer'] = $data;
  header('Location: index.php');
}

function is_loggedin_customer(){
  if(isset($_SESSION['customer']) && $_SESSION['customer'] >0){
    return true;
  }
  return false;
}
function login_error_redirect_customer(){
  header('Location: login');
  $_SESSION['error'] = 'You must be logged in to access that module';
}
//pagenation
 function pagination($query, $per_page = 10,$page = 1, $url = '?'){  
 global $db;      
      $query = "SELECT COUNT(*) as `num` FROM {$query}";
      $row = mysqli_fetch_assoc($db->query($query));
      $total = $row['num'];
        $adjacents = "2"; 

      $page = ($page == 0 ? 1 : $page);  
      $start = ($page - 1) * $per_page;               
    
      $prev = $page - 1;              
      $next = $page + 1;
        $lastpage = ceil($total/$per_page);
      $lpm1 = $lastpage - 1;
      
      $pagination = "";
      if($lastpage > 1)
      { 
        $pagination .= '<ul class="pagination">';
                    $pagination .= "<li class='pull-left' style='margin-top:2px;padding-right:5px;'>Page $page of $lastpage</li>";
        if ($lastpage < 7 + ($adjacents * 2))
        { 
          for ($counter = 1; $counter <= $lastpage; $counter++)
          {
            if ($counter == $page)
              $pagination.= "<li><a class='active'>$counter</a></li>";
            else
              $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";          
          }
        }
        elseif($lastpage > 5 + ($adjacents * 2))
        {
          if($page < 1 + ($adjacents * 2))    
          {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
            {
              if ($counter == $page)
                $pagination.= "<li><a class='active'>$counter</a></li>";
              else
                $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";          
            }
            $pagination.= "<li class='dot'>...</li>";
            $pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
            $pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";    
          }
          elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
          {
            $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
            $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
            $pagination.= "<li class='dot'>...</li>";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
            {
              if ($counter == $page)
                $pagination.= "<li><a class='active'>$counter</a></li>";
              else
                $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";          
            }
            $pagination.= "<li class='dot'>..</li>";
            $pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
            $pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";    
          }
          else
          {
            $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
            $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
            $pagination.= "<li class='dot'>..</li>";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
            {
              if ($counter == $page)
                $pagination.= "<li><a class='active'>$counter</a></li>";
              else
                $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li><br>";          
            }
          }
        }
        
        if ($page < $counter - 1){ 
          $pagination.= "<li><a href='{$url}page=$next'>Next</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>Last</a></li>";
        }else{
          $pagination.= "<li><a class='active'>Next</a></li>";
                $pagination.= "<li><a class='active'>Last</a></li>";
            }
        $pagination.= "</ul>\n";    
      }
    
    
        return $pagination;
    }
function has_permission($permission = 'admin' ){
 global $userdata;
  $permissions = explode(',',$userdata['permission']);
  if (in_array($permission, $permissions,true)){
      return true;
  }
   return false;
}

function login_error_redirect_admin(){
  header('Location:index.php');
  $_SESSION['error'] = 'You must be logged as an admin  in to access that page';
}