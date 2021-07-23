@extends('member.layouts.member')

@section('title',__('views.member.campaigns.title', ['name' => $company->name]) )

@section('content')
    <div class="clearfix"></div>

    <div class="users-page clearfix">
        @if (count($campaigns))
            <table class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>{{ __('views.member.campaigns.name') }}</th>
                    <th>{{ __('views.member.campaigns.created_at') }}</th>
                    <th>{{ __('views.member.campaigns.updated_at') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach($campaigns as $campaign)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="#" data-toggle="modal" data-target="#newslettersModal{{ $loop->index + 1 }}">{{ $campaign->name }}</a></td>
                        <td>{{ $campaign->created_at }}</td>
                        <td>{{ $campaign->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @foreach($campaigns as $campaign)
            <div class="modal fade newsletter-modal" id="newslettersModal{{ $loop->index + 1 }}" data-campaign-id="{{ $campaign->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            <h4 class="modal-title">{{ $campaign->name }}</h4>
                        </div>

                        <div class="modal-body">
                            <div class="newsletters-list"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <script>
				window.newsletters = {!! $newsletters !!};
            </script>
        @else
            {{ __('views.member.campaigns.not_available') }}
        @endif
    </div>
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/member/js/campaign.js')) }}
@endsection
