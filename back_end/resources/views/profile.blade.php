@extends('layouts.app')

@section('content')

    <section class="section1">
        <div id="profile">
            Profile
            @if (Auth::user())
                @if (Auth::user()->id == $user->id)
                    <div style="float:right;" align="right">
                        <a href={{url('user/'.$user->id . "/edit")}}>
                        <button class="button1">
                            EDIT
                        </button>
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </section>
    </div>


        <style type="text/css">
            .left-section{
                text-align: center;
            }
            .row{
                padding: 0;
                margin: 0;
            }
            .rowx{
                padding: 0 15px;
                margin-top: 32px;
            }
            textarea{
                width: 100% !important;
                margin: 0 !important;
                padding: 12px;
            }
            .post-entity{
                text-align: right;
                 height: unset !important;
            }
            .the-post{
                border: solid 1px #DCDCDC;
                margin-bottom: 12px;
                padding: 12px;
                padding-bottom: 0;
                background: rgba(220, 220, 220, 0.4);
            }
            .image-post{
                width: 48px;
                height: 48px;
                border-radius: 4px;
            }
            .tanggal-post{
                color: #777;
            }
            .text-post{
                background: #FFF;
                margin-left: -12px;
                margin-top: -12px;
                margin-right: -12px;
                margin-top: 12px;
                width: calc(100% + 24px);
                padding: 12px !important;
                color: #888;
            }
            .button-post{
                border: solid 1px rgba(0, 0, 0, .1);
                padding: 4px 8px;
                border-radius: 0;
                background: #396FB9;
                color: white;
                margin-top: 8px;
            }
            .input-post{
                background: unset;
                border: none;
            }
            .title-post-section{
                border: none;
                background: unset;
            }
        </style>
        <div class="row rowx">
            <div class="col-md-4 left-section">
                <div>
                    <img src="{{$user->profile_picture}}" height="120px" style="margin-top: 60px; margin-bottom: 60px;">
                </div>
                <div>
                    {{ $user->name }}
                </div>
                <div style="font-size: 14px;">
                    <div>
                        {{ $user->address }}
                    </div>
                    <div>
                        {{ $user->email }}
                    </div>
                    <div>
                        {{ $user->mobile_number }}
                    </div>
                </div>
                <br>
                <div style="font-size: 15px;">
                    <div>
                        Last Activities
                    </div>
                    <div>
                        <ul class="ulist" style="text-align: left;">
                            <li class="list">Create a new Thread "Welcome to Bali Land" on <b>Tour and Trip Group</b></li>
                            <li class="list">Comment on thread "Wow" on <b>Uncategorized Thread</b></li>
                            <li class="list">Create a new Thread "Welcome to Bali Land" on <b>Tour and Trip Group</b></li>
                            <li class="list">Comment on thread "Wow" on <b>Uncategorized Thread</b></li>
                            <li class="list">Create a new Thread "Welcome to Bali Land" on <b>Tour and Trip Group</b></li>
                            <li class="list">Comment on thread "Wow" on <b>Uncategorized Thread</b></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="margin-top: 2px;">

                <div class="the-post row" style="background: unset; border: none; padding: 0;">
                    <div class="col-md-12" style="padding: 0">
                        <div id="organizationTitle" style="width: 100%;">
                            {{$user->organization_name}}
                        </div>

                        <div id="organizationImage" style="width: 100%;">
                            <img src="{{$user->organization_structure}}" alt="Struktur Organisasi">
                        </div>

                        <style type="text/css">
                            .key{
                                font-size: 1em;
                                color: #222;
                            }
                            .value{
                                font-size: 1.2em;
                                color: #555;
                                margin-bottom: 8px;
                            }
                        </style>
                        <div id="organizationProfile" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="key">
                                        <i class="glyphicon glyphicon-align-left"></i> Deskripsi
                                    </div>
                                    <div class="value">
                                        {{$user->description}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="key">
                                        <i class="glyphicon glyphicon-knight"></i> Owner
                                    </div>
                                    <div class="value">
                                        {{ $user->owner }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="key">
                                        <i class="glyphicon glyphicon-leaf"></i> Peran
                                    </div>
                                    <div class="value">
                                        {{$user->role->name}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="key">
                                        <i class="glyphicon glyphicon-globe"></i> Website
                                    </div>
                                    <div class="value">
                                        {{ $user->website }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="key">
                                        <i class="glyphicon glyphicon-grain"></i> Kebutuhan
                                    </div>
                                    <div class="value">
                                        {{ $user->needs }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border: solid 1px rgba(0, 0, 0, .1); margin: 0; margin-top: 32px; width: 100%; max-width: unset;" />
                <div class="the-post row title-post-section">
                    <div class="col-md-12" style="padding: 0">
                        TIMELINE
                    </div>
                </div>

                @if (Auth::user())
                <div class="the-post input-post row" style="padding: 0">
                    <div class="col-md-12" style="padding: 0">

                        @if (Auth::user()->id == $user->id)
                        {!! Form::open(['method' => 'post', 'url' => url('user/'. $user->id . '/timeline')]) !!}
                        {!! Form::textarea("timeline_post", null, ['placeholder' => 'Whats going on?', 'size' => '20x5']) !!}
                        @endif
                        <div class="row" style="padding: 0">
                            <div class="col-md-12 post-entity" style="padding: 0">
                                <input type="file" name="media" id="media" class="button3" accept="image/*">
                                <label for="media"  style="margin-bottom: 12px;"><img src="/assets/photo.png" width="20px"></label>
                                <button class="button-post">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @for($i = sizeof($posts) - 1; $i > -1; $i--)
                <div class="the-post row">
                    <div class="col-md-12" style="padding: 0">
                        <div class="row">
                            <div class="col-md-1" style="padding: 0">
                                <img src="{{$user->profile_picture}}" class="image-post">
                            </div>
                            <div class="col-md-11" style="padding: 0; margin-top: 5px;">
                                <div style="font-weight: bold;">
                                    {{ $user->name }}
                                </div>
                                <div class="tanggal-post">
                                    {{$posts[$i]->created_at}}
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 0">
                            <div class="col-md-12 text-post" style="padding: 0">
                                {{$posts[$i]->message}}
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
@endsection
