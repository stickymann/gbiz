<?php defined('SYSPATH') or die('No direct script access.');

class Login_Controller extends Controller
{
    public function index()
    {
		Auth::instance()->logout();

		$loginpage = new View('login/login.view');
		$loginpage->form = array('username' => '','password' => '');
		$loginpage->isLoginOk=0;
		$loginpage->status ='';
		
		if($_POST)
		{
			$myuser = $_POST['username'];
			$mypass =  $_POST['password'];
			//echo "sha1hash: ".sha1($mypass)."<br>";
			//echo "authhash1: ".Auth::instance()->hash_password($mypass)."<br>";
			//echo "authhash2: ".Auth::instance()->hash($mypass)."<br>";
			$user = ORM::factory('user',$myuser); //select * from users where username=$myuser
           	if(!($user->username == '')) //id == 0, user not found
			{	
		        $exdate = strtotime(str_replace('/', '-',$user->expiry_date)); 
				$curdate = strtotime(date("Y/m/d"));
				if($user->enabled && ($exdate > $curdate )) 
				{	
					if(Auth::instance()->login($myuser,$mypass))
					{
						$loginpage->isLoginOk=1;
						$loginpage->status .= 'Welcome '.$user->username.'<br>';
						$loginpage->status .= $user->email.'<br>';
						$loginpage->status .= $user->password.'<br>';
						$loginpage->status .= 'setting up session<br>';
						$loginpage->status .= 'redirecting........<br>';
						url::redirect('app');
					}
					else
					{
						$loginpage->status .= 'Invalid password<br>';
					}
				}
				else
				{
					$loginpage->status .= 'User account disabled or expired<br>';
				}
            }
			else
			{
				$loginpage->status .= 'User account not found<br>';
			}
			
			/*
			else
			{
				$user = ORM::factory('user');
				//$user->id = 100;
				$user->username = $myuser;
				$user->idname = strtoupper($myuser);
				$user->password = Auth::instance()->hash_password($mypass);
				// if the user was successfully created...
				if ($user->add(ORM::factory('role', 'login')) AND $user->save()) 
				{
			        // login using the collected data
					Auth::instance()->login($myuser, $mypass);
					$loginpage->status .= 'New User:: '.html::specialchars(Auth::instance()->get_user()->username).'created <br>';
                    url::redirect('app');
				}
			}
			*/
			
		}
		$loginpage->render(TRUE);
	}
}
