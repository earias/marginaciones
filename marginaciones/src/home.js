import React from 'react'
import { Grid,Paper, Avatar,Box,Link, TextField, Button, Typography,Link as Nv } from '@material-ui/core'
import { useHistory, useParams } from "react-router-dom";
 
const Home=()=>{
 

    const btnstyle={margin:'8px 0'};
 
    const {users} = useParams();  
    let history = useHistory(); 
 
    const usersss = localStorage.getItem('users');
      
    const logout = () => 
    {
        localStorage.removeItem("users")
        history.push("/");
    }
 
    return(
        <div className="">
           <Grid>
             <div style={{  float:"right",marginRight:"50px"}}>        
               <Button type='submit' onClick={logout} color='primary' justifyContent="flex-end" variant="contained" style={btnstyle} fullWidth>Logout</Button>
            </div>
          </Grid>      

         <span style={{color:"blue"}}>{usersss}</span>
            

        </div>
    )
}
 
export default Home