@if(auth()->user()->id == 1)
<!-- Here we show all actions buttons all modules for Admin. -->
    <!-- Here we show all action button for Users -->
    @can($viewGate)
        <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
            {{ trans('global.view') }}
        </a>
        @endcan 
        @if($row->posted == 1)
        @else
            <a class="btn btn-xs btn-warning" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}?type={{request()->get('type')}}">
            {{ trans('global.edit') }}
            </a>
        @endif
        @can($deleteGate)
        <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
        </form>
    @endcan  
@else
<!-- Here we show all actions buttons only for invoices modules. -->
    @if($crudRoutePart == 'invoices')
        <a class="btn btn-xs btn-dark" href="{{ route('frontend.' . $crudRoutePart . '.pdf', ['invoice' => $row->id]) }}" target="_blank">
            Print
        </a>
    @endif
    <!-- Here we show all actions buttons all modules for Frontent. -->
    @can($viewGate)
        <a class="btn btn-xs btn-primary" href="{{ route('frontend.' . $crudRoutePart . '.show', $row->id) }}">
            {{ trans('global.view') }}
        </a>
    @endcan
    @can($editGate)
        <a class="btn btn-xs btn-info" href="{{ route('frontend.' . $crudRoutePart . '.edit', $row->id) }}">
            {{ trans('global.edit') }}
        </a>
    @endcan
    @can($deleteGate)
        <form action="{{ route('frontend.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
        </form>
    @endcan
@endif
