<?php
    function loginAuthenticate($username, $password)
    {
        $usernameS = array('admin@admin.com'=>'admin', 'miguel.Kuka@gmail.com'=>'6290');
        foreach($usernameS as $u => $p)
            {
                if($username == $u)
                {
                    if ($password == $p)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
    }