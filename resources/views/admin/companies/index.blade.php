@extends('admin.layouts.admin')

@section('title', __('views.admin.company.index.title'))

@section('content')
    <div class="row">
        <a class="btn btn-info pull-right" href="{{ route('admin.companies.add') }}"
           data-toggle="tooltip" data-placement="top"
           data-title="{{ __('views.admin.company.index.add') }}">
            <i class="fa fa-pencil"></i>
        </a>
        <table class="table table-striped table-bordered dt-responsive nowrap table-align-middle" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>@sortablelink('logo', __('views.admin.company.index.logo'),['page' => $companies->currentPage()])
                </th>
                <th>@sortablelink('name', __('views.admin.company.index.name'),['page' => $companies->currentPage()])
                </th>
                <th>@sortablelink('industry', __('views.admin.company.index.industry'),['page' =>
                    $companies->currentPage()])
                </th>
                <th>@sortablelink('active', __('views.admin.company.index.status'),['page' =>
                    $companies->currentPage()])
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>
                        @if($company->logo)
                            <a href="{{ route('admin.companies.users', [$company->id]) }}">
                                <img class="company-logo" src="{{asset('/storage/images/companies/' . $company->logo)}}" alt="company_logo"
                                     style="max-height: 35px;" />
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.companies.users', [$company->id]) }}">{{ $company->name }}</a>
                    </td>
                    <td>{{ $company->industry->name }}</td>
                    <td>
                        @if($company->active)
                            <span class="label label-primary">{{ __('views.admin.company.index.active') }}</span>
                        @else
                            <span class="label label-danger">{{ __('views.admin.company.index.inactive') }}</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.companies.show', [$company->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.company.index.show') }}">
                            <i class="fa fa-eye"></i>
                        </a>

                        <a class="btn btn-xs btn-info" href="{{ route('admin.companies.edit', [$company->id]) }}"
                           data-toggle="tooltip" data-placement="top"
                           data-title="{{ __('views.admin.company.index.edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('administrator'))
                            <a href="{{ route('admin.companies.destroy', [$company->id]) }}" class="btn btn-xs btn-danger company_destroy" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.admin.company.index.delete') }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $companies->links() }}
        </div>
    </div>
@endsection
