import React, { Component } from 'react';
import {Link} from 'react-router-dom';
import axios from 'axios';
import Swal from 'sweetalert2'
import {Marginaciones} from './Marginaciones'

class AddMarginaciones extends Component
{

    state = {
        libro: '',
        partida:'',
        folio:'',
        annio:'',
        tipo:'VACIO',
        texto:'',
        libromarg: '',
        marginacion:'',
        habilitado:'',
        textoh:'',
        iniciales:'',
        jefe:'',
        user:'',
        validate_err: [],
        
    }

    handleInput = (e) => {
        this.setState ({
            [e.target.name]: e.target.value
        });

    }

    newMarginacion = async (e) =>{
        document.getElementById('addbtn').disabled = false;
        document.getElementById('addbtn').innerHTML = "Guardar";
      

   
        this.setState({
               
                libro: '',
                partida:'',
                folio:'',
                annio:'',
                tipo:'VACIO',
                texto:'',
                libromarg: '',
                marginacion:'',
                habilitado:'',
                textoh:'',
                iniciales:'',
                jefe:'',
                user:'',

            });

    }
    saveMarginacion = async (e) => {
        e.preventDefault();

    

        document.getElementById('addbtn').innerHTML = "Guardando..."
        const res = await axios.post('http://localhost:8000/api/add-marginacion', this.state)
        if(res.data.status === 200){

            console.log(res.data);
            document.getElementById('addbtn').disabled = true;
            document.getElementById('addbtn').innerHTML = "Almacenado";
        
            // console.log(item.id);
              let timerInterval
              Swal.fire({
                title: 'Realizado',
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
                  console.log('Cerrado automáticamente')
                }
              });
            //   this.props.history.push('/');
            // this.setState({
               
            //     libro: '',
            //     partida:'',
            //     folio:'',
            //     annio:'',
            //     tipo:'VACIO',
            //     texto:'',
            //     libromarg: '',
            //     marginacion:'',
            //     habilitado:'',
            //     textoh:'',
            //     iniciales:'',
            //     jefe:'',
            //     user:'',

            // });
           
        }
    }

render(){
    const buttonNew = {       
        marginLeft:"20px",
      };
    return(
        <div className="container">
            <div className="row">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header">
                            <div className='col-md-4'>
                                <h4>AGREGAR MARGINACIÓN                              
                                    
                                </h4>
                            </div>
                            <div className='col-md-8'>
                            <Link to={'/'} className="btn btn-primary btn-sm float-end">REGRESAR</Link>  
                                                                 
                                
                                {/* <Link to={'/AddMarginacion'} className="btn btn-success btn-sm">NUEVA</Link> */}
                             
                            </div>
                        </div>
                        <div className='card-body'>
                            <form onSubmit={this.saveMarginacion}>
                                <div className='form row'>
                                    
                              <div className='form group col-md-3'>

                                <label for="tipo">Tipo</label>
                                <select name="tipo" id="tipo" className='form-control' onChange={this.handleInput}  value={this.state.tipo} required>
                               
                                <option defaultValue={'VACIO'}>No Requerido</option>
                                <option value="NAC">Nacimiento</option>
                                <option value="DEF">Defunción</option>
                                <option value="MAT">Matrimonio</option>
                                <option value="RP">Régimen Patrimonial</option>
                                <option value="DIV ">Divorcio</option>
                                <option value="UNM">Unión no Matrimonial</option>
                                <option value="AM">Acta de Matrimonio</option>
                                <option value="NREC">Rectificación de Nacimiento</option>
                                <option value="DiREC">Rectificación de Defunción</option>
                                <option value="MREC">Rectificación de Matrimonio</option>
                                <option value="DREC">Rectificación de Divorcio</option>
                                <option value="RPREC">Rectificación de Régimen Patrimonial</option>
                                <option value="NREP">Reposición de Nacimiento</option>
                                <option value="DREP">Reposición de Defunción</option>
                                <option value="MREP">Reposición de Matrimonio</option>
                                <option value="RPREP">Reposición de Régimen Patrimonial</option>
                                <option value="DiREP">Reposición de Divorcio</option>
                                <option value="ADO">Adopción</option>
                                <option value="LEN">LEN</option>
                                <option value="NSUB">Subsidirio Nacimiento</option>
                                <option value="DSUB">Subsidiario Defunción</option>
                                <option value="NMOD">Modificaciones Nacimiento</option>
                                <option value="DMOD">Modificaciones Defunción</option>
                                <option value="MMOD">Modificaciones Matrimonio</option>
                                <option value="DiMOD">Modificaciones Divorcio</option>
                                <option value="RPMOD">Modificaciones Régimen Patrimonial</option>
                                <option value="NRECN">Rectificación Notario Nacimiento</option>
                                <option value="DRECN">Rectificación Notario Defunción</option>
                                <option value="MRECN">Rectificación Notario Matrimonio</option>
                                <option value="DiRECN">Rectificación Notario Divorcio</option>
                                <option value="RPRECN">Rectificación Notario Régimen Patrimonial</option>
                                <option value="AP">Acuerdos de Paz</option>
                                </select>
                                <span className='text-danger'>{this.state.validate_err.tipo}</span>
                                </div>
                                <div className='form group col-md-3'>
                                        <label>Año</label>
                                        <input type="number" name="annio" min="1879" max="2050" onChange={this.handleInput}  value={this.state.annio} className='form-control' width="50%" ></input>                                  
                                        <span className='text-danger'>{this.state.validate_err.annio}</span>
                                    </div>
                                    <div className='form group col-md-3'>
                                        <label>Libro</label>
                                        <input type="number" name="libro" min="1" max="225" onChange={this.handleInput} value={this.state.libro} className='form-control' ></input>                                  
                                        {/* <span className='text-danger'>{this.state.error_list.libro}</span> */}
                                    </div>
                                    <div className='form group col-md-3'>
                                        <label>Partida</label>
                                        <input type="text" name="partida" onChange={this.handleInput}  value={this.state.partida} className='form-control' ></input>                                  
                                        {/* <span className='text-danger'>{this.state.error_list.partida}</span> */}
                                    </div>
                                    
                                </div>
                              
                                <div className='form row'>
                              <div className='form group col-md-4'>
                                  <label>Libro Marginación</label>
                                  <input type="text" name="libromarg" onChange={this.handleInput}  value={this.state.libromarg} className='form-control' required></input>                                  
                                  {/* <span className='text-danger'>{this.state.error_list.annio}</span> */}
                               </div>
                               <div className='form group col-md-4'>
                                        <label>Folio</label>
                                        <input type="text" name="folio" onChange={this.handleInput}  value={this.state.folio} className='form-control' required></input>                                  
                                        {/* <span className='text-danger'>{this.state.error_list.folio}</span> */}
                                    </div>

                               <div className='form group col-md-4'>
                                  <label>No Marginación</label>
                                  <input type="text" name="marginacion" onChange={this.handleInput}  value={this.state.marginacion} className='form-control' required></input>                                  
                                  {/* <span className='text-danger'>{this.state.error_list.annio}</span> */}
                               </div>

                               <div className='form group col-md-12'>
                                  <label>Texto</label>
                                  <textarea type="textarea" rows={3} name="texto" onChange={this.handleInput}  value={this.state.texto} className='form-control' required></textarea>                                  
                                  {/* <span className='text-danger'>{this.state.error_list.texto}</span> */}
                              </div>
                               <div className='form group col-md-2'>
                                <label for="habilitado">Inhabilitado</label>
                                    <select name="habilitado" id="habilitado" className='form-control' onChange={this.handleInput}  value={this.state.habilitado}  required>
                                    {/* <span className='text-danger'>{this.state.error_list.tipo}</span> */}
                                        <option value="Seleccione">Seleccione</option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                     </select>
                                  {/* <input type="checkbox" name="habilitado" onChange={this.handleInput}  value={this.state.habilitado} defaultChecked className='form check group'></input>                                
                                  <label className='form-check-label'> Inhabilitado</label>
                                  <span className='text-danger'>{this.state.error_list.annio}</span> */}
                               </div>
                               
                               <div className='form group col-md-10'>
                                  <label>Texto inhabilitado</label>
                                  <textarea type="textarea" name="textoh"  rows={3} onChange={this.handleInput}  value={this.state.textoh} className='form-control'  required></textarea>                                  
                                  {/* <span className='text-danger'>{this.state.error_list.annio}</span> */}
                               </div>
                               <div className='form group  col-md-2'>
                                  <label>Iniciales</label>
                                  <input type="text" name="iniciales" width={100} onChange={this.handleInput}  value={this.state.iniciales} className='form-control' required></input>                                  
                                  {/* <span className='text-danger'>{this.state.error_list.annio}</span> */}
                               </div>
                               <div className='form group  col-md-8'>
                                  <label>jefe</label>
                                  <input type="text" name="jefe" onChange={this.handleInput}  value={this.state.jefe} className='form-control' required></input>                                  
                                  {/* <span className='text-danger'>{this.state.error_list.annio}</span> */}
                               </div>
                               <div className='form group  col-md-2'>
                                  <label>Usuario</label>
                                  <input type="text" name="user" onChange={this.handleInput}  value={this.state.user} className='form-control' required></input>                                  
                                  {/* <span className='text-danger'>{this.state.error_list.annio}</span> */}
                               </div>
                               </div>
                               <div className='form group text-center'>
                                  <button type="submit" id='addbtn' className='btn btn-success'>Guardar</button> 
                                  <button onClick={this.newMarginacion}  id='newbtn' className='btn btn-success' style={buttonNew} >NUEVA</button>                     
                              </div>
                              <div>
                              
                              </div>
                            </form>
                            
                        </div>
                    </div>                    
                </div>                
            </div>
        </div>
    )
}
}

export default AddMarginaciones;
