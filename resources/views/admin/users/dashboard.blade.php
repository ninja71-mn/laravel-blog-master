@extends('layouts.admin')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-selection__choice__remove {
            margin-right: 3px;
            border-right: 0 !important;
        }

        .select2-selection__choice {
            padding-right: 5px !important;
            padding-left: 5px !important;
            color: black !important;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 42px;
            user-select: none;
            -webkit-user-select: none;
        }

        .form-input {
            width: 250px;
            padding: 20px;
            background: #fff;
            border: 2px dashed #555;
        }

        .form-input input {
            display: none;
        }

        .form-input label {
            display: block;
            width: 100%;
            height: 50px;
            line-height: 50px;
            text-align: center;
            background: #333;
            color: #fff;
            font-size: 15px;
            font-family: "Open Sans", sans-serif;
            text-transform: Uppercase;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
        }

        .form-input img {
            width: 100%;
            margin-top: 10px;
        }

        .skills input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        .select2-container{
            width: 100% !important;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{url('storage/avatar/'.$user->avatar)}}" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                    <p class="text-muted text-center">{{($user->roles->first())?$user->roles->first()->name:null}}</p>

                    <ul class="list-group list-group-unbordered mb-3 ">
                        <li class="list-group-item">
                            <b>{{__('dashboard.last_login')}}</b> <span class="float-right">{{Session::get('last_login')}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('dashboard.last_ip')}}</b> <span class="float-right">{{Session::get('last_ip')}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('dashboard.lang')}}</b> <span class="float-right">{{App::getLocale()}}</span>
                        </li>
                    </ul>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary {{(Session::get('local')=='en'?'ltr':'rtl')}}">
                <div class="card-header">
                    <h3 class="card-title">{{__('dashboard.aboutMe')}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> {{__('dashboard.education')}}</strong>

                    <p class="text-muted">
                        {{($user->education)?$user->education:__('dashboard.notSet')}}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> {{__('dashboard.location')}}</strong>

                    <p class="text-muted">
                        {{($user->city->first())?$user->city->first()->province->name.' -- '.$user->city->first()->name:__('dashboard.notSet')}}
                    </p>
                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> {{__('dashboard.skills')}}</strong>
                    <p class="text-muted">
                    @if(count($user->skills)>0)
                        <ul class="list-inline">
                            @foreach($user->skills as $skill)
                                <li class="skill">{{$skill->name}}</li>
                            @endforeach
                        </ul>
                    @else
                        Not Set
                        @endif
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> {{__('dashboard.notes')}}</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                            enim neque.</p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                         alt="user image">
                                    <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>

                                <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                        Like</a>
                                    <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                                </p>

                                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post clearfix">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                         alt="User Image">
                                    <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                    <span class="description">Sent you a message - 3 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>

                                <form class="form-horizontal">
                                    <div class="input-group input-group-sm mb-0">
                                        <input class="form-control form-control-sm" placeholder="Response">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-danger">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg"
                                         alt="User Image">
                                    <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                    <span class="description">Posted 5 photos - 5 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                                <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                        Like</a>
                                    <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                                </p>

                                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-envelope bg-primary"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                        <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-user bg-info"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your
                                            friend request
                                        </h3>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-comments bg-warning"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post
                                        </h3>

                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-camera bg-purple"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                        <div class="timeline-body">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            {!! Form::open(['route' => ['users.update',$user->id], 'method' => 'put','enctype'=>'multipart/form-data']) !!}
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group @if($errors->has('avatar')) has-error @endif">
                                        <div class="form-input">
                                            <label for="file-ip-1">{{__('dashboard.uploadImage')}}</label>
                                            <input name="avatar" type="file" id="file-ip-1" accept="image/*"
                                                   onchange="showPreview(event);" value="{{$user->avatar}}">
                                            <div class="preview">
                                                <img id="file-ip-1-preview"
                                                     src="{{url('storage/avatar/'.$user->avatar)}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="form-group @if($errors->has('name')) has-error @endif {{(Session::get('local')=='en'?'ltr':'rtl')}}">
                                        {!! Form::label(__('dashboard.name'), null, ['class' => 'control-label ']) !!}
                                        {!! Form::text('name', $user->name, ['class' => 'form-control '.(Session::get('local')=='en'?'ltr':'rtl').($errors->has('name')?' is-invalid ':''),'placeholder'=>__('dashboard.placeholders.name')]) !!}
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback"
                                                  role="alert">{!! $errors->first('name') !!}</span>
                                        @endif
                                    </div>
                                    <div class="form-group @if($errors->has('phone')) has-error @endif {{(Session::get('local')=='en'?'ltr':'rtl')}}">
                                        {!! Form::label(__('dashboard.phone'), null, ['class' => 'control-label']) !!}
                                        {!! Form::text('phone', $user->phone, ['class' => 'form-control ltr'.($errors->has('phone')?'is-invalid':''),'placeholder'=>__('dashboard.placeholders.phone')]) !!}
                                        @if($errors->has('phone'))
                                            <span class="invalid-feedback"
                                                  role="alert">{!! $errors->first('phone') !!}</span>
                                        @endif
                                    </div>

                                    <div class="form-group @if($errors->has('email')) has-error @endif {{(Session::get('local')=='en'?'ltr':'rtl')}}">
                                        {!! Form::label(__('dashboard.email'), null, ['class' => 'control-label']) !!}
                                        @if(auth()->user()->can('set admin') )
                                            {!! Form::email('email', $user->email, ['class' => 'form-control ltr'.($errors->has('email')?'is-invalid':'')]) !!}
                                        @else
                                            {!! Form::email('email', $user->email, ['class' => 'form-control ltr','disabled'=>'disabled']) !!}

                                        @endif
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback"
                                                  role="alert">{!! $errors->first('email') !!}</span>
                                        @endif
                                    </div>

                                    <div class="form-group @if($errors->has('education')) has-error @endif {{(Session::get('local')=='en'?'ltr':'rtl')}}">
                                        {!! Form::label(__('dashboard.education'), null, ['class' => 'control-label']) !!}
                                        {!! Form::text('education', ($user->education)?$user->education:null, ['class' => 'form-control '.($errors->has('education')?'is-invalid':''),'placeholder'=>__('dashboard.placeholders.education')]) !!}
                                        @if($errors->has('education'))
                                            <span class="invalid-feedback"
                                                  role="alert">{!! $errors->first('education') !!}</span>
                                        @endif
                                    </div>

                                    {{-- <div class="form-group @if($errors->has('skills')) has-error @endif">
                                         {!! Form::label('Skills', null, ['class' => 'control-label']) !!}
                                         {!! Form::text('skills', $user->skills, ['class' => 'form-control '.($errors->has('skills')?'is-invalid':''),'placeholder'=>'Skill1*Skill2*...']) !!}
                                         @if($errors->has('skills'))
                                             <span class="invalid-feedback"
                                                   role="alert">{!! $errors->first('skills') !!}</span>
                                         @endif
                                     </div>--}}

                                    <div class="form-group {{(Session::get('local')=='en'?'ltr':'rtl')}}">
                                        {!! Form::label(__('dashboard.province'), null, ['class' => 'control-label']) !!}
                                        {!! Form::select(null,$provinces, null, ['class' => 'form-control','id'=>'province_id','placeholder'=>'']) !!}
                                    </div>

                                    <div class="form-group {{(Session::get('local')=='en'?'ltr':'rtl')}}" id="cities">
                                        <label for="city_id">{{__('dashboard.city')}}</label><select name="city_id" id="city_id" class="cities rtl"></select>
                                    </div>

                                    <div class="form-group @if($errors->has('skill_id')) has-error @endif {{(Session::get('local')=='en'?'ltr':'rtl')}}">
                                        {!! Form::label(__('dashboard.skills'), null, ['class' => 'control-label']) !!}
                                        {!! Form::select(null,$skills, null, ['class' => 'form-control '.($errors->has('skill_id')?'is-invalid':''),'id'=>'skill_id','placeholder'=>'']) !!}
                                    </div>


                                    <div class="form-group skills">
                                        @if($errors->has('skill_id'))
                                            <span class="invalid-feedback"
                                                  role="alert">{!! $errors->first('skill_id') !!}</span>
                                        @endif
                                        @if(count($user->skills)>0)
                                            @foreach($user->skills as $skill)
                                                <span id="skill{{$skill->id}}">
                                                <input name="skills[]" class="form-check-input" type="checkbox"
                                                       id="flexCheckDefault{{$skill->id}} " value="{{$skill->id}}"
                                                       checked>
                                                <label class="form-check-label" for="flexCheckDefault{{$skill->id}}">
                                                    <div class="btn-group border border-1 border-secondary rounded">
                                                        <button type="button"
                                                                class="btn btn-default">{{$skill->name}}</button>
                                                        <button type="button" class="btn btn-default ion-close"
                                                                onclick="removeSkill({{$skill->id}})"></button>
                                                    </div>
                                                </label>
                                                </span>
                                            @endforeach
                                        @endif

                                    </div>

                                    <div class="form-group {{(Session::get('local')=='en'?'ltr':'rtl')}}">
                                        {!! Form::submit(__('dashboard.save'), ['class' => 'btn btn-sm btn-primary']) !!}
                                    </div>
                                </div>

                            </div>

                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "5000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                messageClass: 'toast-message {{(Session::get('local')=='en'?'ltr':'rtl')}}'
            };
            var skills = $('.skills');
            var cities = $('.cities');
            $('#province_id').select2({
                placeholder: "{{__('dashboard.placeholders.province')}}",
                allowClear: true,
                width: '100%',

            }).val('{{ ($user->city->first())?$user->city->first()->province->id:null }}');
            $('#province_id').select2().on('select2:close', function () {
                var element = $(this);
                var province = $.trim(element.val());
                if (province != '') {
                    $.ajax({
                        url: "{{route('get.cities')}}",
                        method: "POST",
                        data: "name=" + province + "&_token=" + "{{ csrf_token() }}",
                        dataType: 'json',
                        success: function (response) {
                            cities.html(response);
                        }
                    })
                }else{
                    $('#city_id').find('option').remove().end();
                }
            });

            $('#city_id').select2({
                placeholder: "{{__('dashboard.placeholders.city')}}",
                allowClear: true,
                width: '100%',

            }).append('<option value="{!!  ($user->city->first())?$user->city->first()->id:null  !!}">{!!  ($user->city->first())?$user->city->first()->name:null  !!}</option>');


            $('#skill_id').select2({
                placeholder: "{{__('dashboard.placeholders.skills')}}",
                tags: true,
                allowClear: true,
                width: '100%'
            }).on('select2:close', function () {
                var element = $(this);
                var new_skill = $.trim(element.val());
                var skill = $("#skill" + new_skill);

                if (skill.find("input").val() === new_skill) {
                } else {

                    if (new_skill != '') {
                        $.ajax({
                            url: "{{route('skill.add')}}",
                            method: "POST",
                            data: "name=" + new_skill + "&_token=" + "{{ csrf_token() }}",
                            dataType: 'json',
                            success: function (response) {
                                if (response.status === "added") {
                                    skills.append('<span id="skill' + response.id + '" data-id="' + response.id + '">' +
                                        '<input name="skills[]" class="form-check-input" type="checkbox"' +
                                        ' id="flexCheckDefault' + response.id + ' " value="' + response.id + '"' +
                                        ' checked>' +
                                        '<label class="form-check-label" for="flexCheckDefault' + response.id + '">' +
                                        '<div class="btn-group border border-1 border-secondary rounded">' +
                                        '<button type="button"' +
                                        ' class="btn btn-default">' + response.name + '</button>' +
                                        '<button type="button" class="btn btn-default ion-close" onclick="removeSkill(' + response.id + ')"></button>' +
                                        '</div>' +
                                        '</label>' +
                                        '</span>');
                                } else if (response.status === "exist") {
                                    skills.append('<span id="skill' + response.id + '">' +
                                        '<input name="skills[]" class="form-check-input" type="checkbox"' +
                                        ' id="flexCheckDefault' + response.id + ' " value="' + response.id + '"' +
                                        ' checked>' +
                                        '<label class="form-check-label" for="flexCheckDefault' + response.id + '">' +
                                        '<div class="btn-group border border-1 border-secondary rounded">' +
                                        '<button type="button"' +
                                        ' class="btn btn-default">' + response.name + '</button>' +
                                        '<button type="button" class="btn btn-default ion-close" onclick="removeSkill(' + response.id + ')"></button>' +
                                        '</div>' +
                                        '</label>' +
                                        '</span>');
                                }
                            },
                            error: function(jqXHR) {
                                if(jqXHR.status===422){

                                    toastr.error(jqXHR.responseJSON.errors.name[0],{timeOut: 5000})
                                }

                            }
                        })
                    }
                }

            });
        });

        function removeSkill(id) {
            $('#skill' + id).remove();
        }

        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
