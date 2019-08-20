<table class="table mg-b-0 table-primary table-hover">
              <thead class="bg-info">
                <tr>
                  <th>No.  </th>
                  <th>Fecha</th>
                  <th>Tipo</th>
                  <th>Cantidad</th>
                  <th>P. Unitario</th>
                  <th>Monto</th>
                  <th>Estatus</th>
                </tr>
              </thead>
              <tbody>
                @foreach($productos->inventarios as $key=>$movinvent)
                <tr>
                  <td> {{$key+1}}
                  </td>
                  <td>{{$movinvent->fecha}}</td>
                  <td>{{$movinvent->tipo_operacion}}</td>
                  <td>{{$movinvent->cantidad}}</td>
                  <td>{{number_format($movinvent->punitario,2)}}</td>
                  <td>{{number_format($movinvent->importe,2)}}</td>
                  <td><span class="badge badge-{{$movinvent->estatush['label']}}">{{$movinvent->estatush['estado']}}</span></td>
                </tr>
                @endforeach
              </tbody>
            </table>
