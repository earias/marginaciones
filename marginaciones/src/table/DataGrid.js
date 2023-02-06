import { DataGrid } from '@mui/x-data-grid'
import React, { useState, useEffect } from 'react'
import axios  from 'axios'
import {Link} from 'react-router-dom';
import { Button} from 'react-bootstrap';





const DataTable = () => {

  //const [tableData, setTableData] = useState([])
  const [marginaciones, setTableData] = useState([])

  const [rows, setRows] = useState(marginaciones);
  const [deletedRows, setDeletedRows] = useState([]);

  useEffect(() => {
    axios('http://localhost:8000/api/marginaciones').then(({data})=>{
      setTableData(data.marginaciones);
      //console.log(data.id);
    }
    
    );


  }, [])

  const editButton = (data) => {
    return (
  <Link to={`/edit-marginacion/${data.id}`} >
       <Button  className="btn btn-success btn-sm">
          Editar
       </Button>
   </Link>
    )
  }

  const columns = [
    { field: 'id', flex: 1, minWidth: 50, headerName: 'ID'},
    { field: 'libro', flex: 1, minWidth: 50, headerName: 'Libro' },
    { field: 'partida', flex: 1, minWidth: 50, headerName: 'Partida'},
    { field: 'folio', flex: 1, minWidth: 50, headerName: 'Folio' },
    { field: 'annio', flex: 1, minWidth: 50, headerName: 'Año' },
    { field: 'tipo', flex: 1, minWidth: 50, headerName: 'Tipo' },
    { field: 'texto', flex: 1, minWidth: 50, headerName: 'Texto'},
    { field: 'libromarg', flex: 1, minWidth: 50, headerName: 'Libro M' },
    { field: 'marginacion', flex: 1, minWidth: 50, headerName: 'Marginacion'},
    { field: 'habilitado', flex: 1, minWidth: 50, headerName: 'Inhabilitado'},
    { field: 'textoh', flex: 1, minWidth: 50, headerName: 'Texto M'},
    { field: 'iniciales', flex: 1, minWidth: 50, headerName: 'Iniciales' },
    { field: 'jefe', flex: 1, minWidth: 50, headerName: 'Jefe'},
    { field: 'user', flex: 1, minWidth: 50, headerName: 'Usuario'},
    { field: 'action',flex: 1, minWidth: 50, headerName: '',renderCell: editButton},
  
  ]
  return (
    <div style={{ height: 700, width: '100%' }}>
      <DataGrid
        rows={marginaciones}
        pageSize={10}
        columns={columns}
      />
    </div>
  )
}

export default DataTable