/* eslint-disable no-template-curly-in-string */
import axios from 'axios';
import React, { Component } from 'react';
import {Link, useHistory, useParams } from 'react-router-dom';
import { Grid,  Button, } from '@material-ui/core'
import DataTable from '../table/DataGrid';

import Swal from 'sweetalert2'

const Home=()=>{
 
    var history = useHistory(); 

    const {users} = useParams(); 
    
}
class Marginaciones extends Component
{
    state = {
        marginaciones: [],
        loading: true,
    }

    // async componentDidMount(){
    //     const res = await axios.get('http://localhost:8000/api/marginaciones/');
    //     console.log(res.data);
    //     console.log("componenDidMount");
       
    //     if(res.data.status === 200){
    //         this.setState({
    //             marginaciones:res.data.marginaciones,
    //             loading: false,
    //         })
    //     }
    // }

    deleteMarginacion = async (e,id) => {

        const removeRow = e.currentTarget;
        removeRow.innerText = "Borrando...";


        const res = await axios.delete(`http://localhost:8000/api/delete-marginacion/${id}`);

        if(res.data.status === 200){
            removeRow.closest("tr").remove();
            let timerInterval
              Swal.fire({
                title: 'Eliminado',
                text: res.data.message,
                icon: 'success',
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                  const b = Swal.getHtmlContainer().querySelector('b')
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                  }, 100)
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  console.log('I was closed by the timer')
                }
              })
            console.log(res.data.message);
            }
        
    }


render(){

    var marginaciones_HTLMTABLE = "";
    const cropText = {
        whiteSpace: "nowrap",
        overflow: "hidden",
        textOverflow:"ellipsis",        
        maxWidth:"30px",
      };
    //   const usersss = localStorage.getItem('users');
      
      
    if (this.state.loading) {
        marginaciones_HTLMTABLE = <tr><td colSpan="12"> <h2>Cargando...</h2></td></tr>
    } else {
        marginaciones_HTLMTABLE = 
        this.state.marginaciones.reverse().map( (item) =>{
            return(
                <tr key={item.id}>
                    <td className='text-center'>{item.id}</td>
                    <td className='text-center'>{item.libro}</td>
                    <td className='text-center'>{item.partida}</td>
                    <td className='text-center'>{item.folio}</td>                 
                    <td className='text-center'>{item.annio}</td> 
                    <td className='text-center'>{item.tipo}</td>
                    <td style={cropText}>{item.texto}</td>     
                    <td className='text-center'>{item.libromarg}</td>
                    <td className='text-center'>{item.marginacion}</td>
                    <td className='text-center'>{item.habilitado}</td>  
		            <td style={cropText}>{item.textoh}</td> 
                    <td className='text-center'>{item.iniciales}</td> 
                    <td style={cropText} className='text-center'>{item.jefe}</td>  
		            <td className='text-center'>{item.user}</td>
                    <td className='text-center'>
                        <Link to={`/edit-marginacion/${item.id}`} className="btn btn-success btn-sm">Editar</Link>
                    </td> 
                    {/* <td className='text-center'>
                        <button type='button' onClick={(e) => this.deleteMarginacion (e, item.id)} className='btn btn-danger btn-sm'>Eliminar</button>
                    </td>  */}
                </tr>
            )
        })
    }

    return(
        <div className="container">
           <header>
               <img src="./logo-amss.png" alt="Alcaldia de San Salvador" width={200}/>     

         {/* <span style={{color:"blue"}}>{usersss}</span> */}
           </header>
            <div className="row">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header">
                            <h4>REGISTRO DE MARGINACIÓN                                
                                <Link to={'AddMarginacion'} className="btn btn-primary btn-sm float-end">Nueva Marginación</Link>
                            </h4>
                        </div>
                        <div className="card-body">
                            <table className='table table-bordered table-striped'>
                                <thead>
                                    {/* <tr>
                                    <th className='text-center'>ID </th>
                                        <th className='text-center'> Libro </th>
                                        <th className='text-center'> Partida</th>
                                        <th className='text-center'> Folio</th>
                                        <th className='text-center'> Año</th>
                                        <th className='text-center'> Tipo</th>
                                        <th className='text-center'> Texto</th>					
                                        <th className='text-center'> Libro M </th>
                                        <th className='text-center'> Marginación</th>
                                        <th className='text-center'> Inhabilitado</th>
                                        <th className='text-center'> Texto M</th>
                                        <th className='text-center'> Iniciales</th>
                                        <th className='text-center'> Jefe</th>
					                    <th className='text-center'> Usuario</th>
                                        <th> </th>
                                        <th> </th>

                                    </tr> */}
                                </thead>
                                <tbody>
                                {/* {marginaciones_HTLMTABLE} */}
                                </tbody>
                            </table>
                            <DataTable />
                        </div>
                    </div>                    
                </div>                
            </div>
        </div>
    )
}
}

export default Marginaciones;
