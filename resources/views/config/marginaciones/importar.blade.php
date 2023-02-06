<link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/bootstrap-extended.css') }}">

<div class=" mb-12 pt-1" style="max-width: 500px; margin: 0 auto;">
        
</div>

<form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="form-group mb-4 pt-1" style="max-width: 500px; margin: 0 auto;">
        <img src="../img/logo/logo-amss.png" alt="Alcaldia de San Salvador" width=250/> 
           <div class="custom-file text-left">
               <input type="file" name="file" class="custom-file-input" id="customFile" required accept=".xlsx, .xls, .csv">
               <label id="labelfile" class="custom-file-label" for="customFile">Seleccione archivo</label>
           </div>
     </div>
     <div  style="max-width: 500px; margin: 0 auto;">
        <button id="importar" class="btn btn-primary">Importar Data</button>
        <a class="btn btn-success" style="display:none;" href="{{ route('file-export') }}">Exportar Data</a>
    </div>
            
   </form>

   <section id="table-success">
    <div class="card">
      <!-- datatable start -->
      <div class="table-responsive">
        <table id="table-extended-success" class="table mb-0">
          <thead>
            <tr>
        
              <th>ID</th>
              <th>Libro</th>
              <th>Partida</th>
              <th>Folio</th>
              <th>Año</th>
              <th>Tipo</th>
              <th>Texto</th>
              <th>Libro M</th>
              <th>Marginacion</th>
              <th>Inhabilitado</th>
              <th>Texto</th>
              <th>Iniciales</th>
              <th>Jefe</th>
              <th>Usuario</th>
              <th>fecha</th>
            
            </tr>
          </thead>
          <tbody>
            @foreach($Marginaciones as $marginaciones)
            <tr style="height: 0px">
              <td style="white-space: nowrap; max-width:20px">{{ $marginaciones->id }}</td>
              <td style="white-space: nowrap; max-width:20px">{{ $marginaciones->libro }}</td>
              <td style="white-space: nowrap; max-width:20px">{{ $marginaciones->partida }}</td>
              <td style="white-space: nowrap; max-width:20px">{{ $marginaciones->folio}}</td>
              <td style="white-space: nowrap; max-width:20px">{{ $marginaciones->annio }}</td>
              <td style="white-space: nowrap; max-width:20px">{{ $marginaciones->tipo }}</td>
              <td style="white-space: nowrap;
              overflow: hidden; text-overflow:ellipsis;">{{ $marginaciones->texto }}</td>
              <td style="white-space: nowrap;">{{ $marginaciones->libromarg}}</td>
              <td>{{ $marginaciones->marginacion }}</td>
              <td>{{ $marginaciones->habilitado }}</td>
              <td  style="white-space: nowrap;
              overflow: hidden; text-overflow:ellipsis;">{{ $marginaciones->textoh }}</td>
              <td>{{ $marginaciones->iniciales}}</td>
              <td style="white-space: nowrap;
              overflow: hidden; text-overflow:ellipsis;">{{ $marginaciones->jefe }}</td>
              <td>{{ $marginaciones->user }}</td>
              <td>{{ $marginaciones->created_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- datatable ends -->
    </div>
    {{ $Marginaciones->appends(request()->input())->links() }}
  </section>
  
  @section('css_vendor')
  <link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/swiper.min.css') }}">
  @endsection
  
  @section('css_page')
  <link rel="stylesheet" type="text/css" href="{{ mix('/css/page/search.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ mix('/css/page/swiper.css') }}">
  @endsection
  
  @section('js_page')
  <script src="{{ mix('/js/page/swiper.min.js') }}"></script>
  @endsection
  
  @section('js_custom')

  <script src="{{ mix('/js/custom/page-search.js') }}"></script>
  <script src="/acciones/user.js"></script>

  @endsection
  
  <style>
    .croptext{
          white-space: 'nowrap';
          overflow: "hidden";
          text-overflow:"ellipsis";        
          max-width:"30px";
    }
  </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>
  $('#customFile').change(function (e) {
  var file = $('#customFile')[0].files[0].name;
  $('#labelfile').html(file);
});
</script>