@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><i class="fi-page-multiple"></i> VAT</h3>
            </div>
            <div class="panel-body">
               <table class="table condence">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-3">VAT %</th>
                        <th class="col-md-3">Create Date</th>
                        <th class="col-md-3">Updated at</th>
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($vats as $vat)
                     <tr>
                        <td>{{ $vat->id }}</td>
                        <td>{{ $vat->vat }} %</td>
                        <td>{{ $vat->created_at }}</td>
                        <td>{{ $vat->updated_at }}</td>
                        <td class="actions">
                           <a href="{{ route('vats.edit', $vat->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
@stop
