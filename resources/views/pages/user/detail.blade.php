@extends('layouts.app')
@section('title', 'Detail Travel')

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
        <div class="container">
            <div class="row g-0">
            <div class="col p-0">
                <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Paket Travel</li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
                </nav>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-8 pe-lg-0">
                <div class="card card-details">
                <h1>{{ $item->title }}</h1>
                <p>{{ $item->location }}</p>
                @if ($item->galleries->count())
                    <div class="gallery">
                        <div class="xzoom-container">
                        <img
                            src="{{ Storage::url($item->galleries->first()->image) }}"
                            class="xzoom"
                            id="xzoom-default"
                            xoriginal="{{ Storage::url($item->galleries->first()->image) }}"
                        />
                        </div>
                        <div class="xzoom-thumbs">
                        @foreach ($item->galleries as $gallery)
                            <a href="{{ Storage::url($gallery->image) }}">
                                <img
                                src="{{ Storage::url($gallery->image) }}"
                                class="xzoom-gallery"
                                width="128"
                                height="92"
                                xpreview="{{ Storage::url($gallery->image) }}"
                                />
                            </a>
                        @endforeach
                        </div>
                    </div>
                @endif
                <h2>Tentang Wisata</h2>
                <p>
                    {!! $item->about !!}
                </p>
                <div class="features row">
                    <div class="col-md-4 border-end">
                    <div class="description">
                        <img
                        src="{{ url('frontend/images/ic_language.png') }}"
                        alt=""
                        class="features-image"
                        />
                        <div class="description">
                        <h3>Featured Event</h3>
                        <p>{{ $item->featured_event }}</p>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4 border-end">
                    <div class="description">
                        <img
                        src="{{ url('frontend/images/ic_language.png') }}"
                        alt=""
                        class="features-image"
                        />
                        <div class="description">
                        <h3>Language</h3>
                        <p>{{ $item->language }}</p>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="description">
                        <img
                        src="{{ url('frontend/images/ic_foods.png') }}"
                        alt=""
                        class="features-image"
                        />
                        <div class="description">
                        <h3>Foods</h3>
                        <p>{{ $item->foods }}</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-details card-right">
                <h2>Members are going</h2>
                <div class="members my-2">
                    <img src="{{ url('frontend/images/member/member1.png') }}" class="member-image me-1">
                    <img src="{{ url('frontend/images/member/member2.png') }}" class="member-image me-1">
                    <img src="{{ url('frontend/images/member/member3.png') }}" class="member-image me-1">
                    <img src="{{ url('frontend/images/member/member4.png') }}" class="member-image me-1">
                </div>
                <hr />
                <h2>Trip Informations</h2>
                <table class="trip-informations">
                    <tr>
                    <th width="50%">Date of Departure</th>
                    <td width="50%" class="text-right">{{ \carbon\carbon::create($item->departure_date)->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr>
                    <th width="50%">Duration</th>
                    <td width="50%" class="text-right">{{ $item->duration }}</td>
                    </tr>
                    <tr>
                    <th width="50%">Type</th>
                    <td width="50%" class="text-right">{{ $item->type }}</td>
                    </tr>
                    <tr>
                    <th width="50%">Price</th>
                    <td width="50%" class="text-right">IDR. {{ number_format($item->price, 0, ',' , '.') }} / person</td>
                    </tr>
                </table>
                </div>
                <div class="join-container">
                @auth
                    <form action="{{ route('checkout-process', $item->id) }}" method="POST">
                        @csrf
                        <div class="d-grid gap-2">
                            <button class="btn btn-join-now mt-3 py-2" type="submit">
                                Join Now
                            </button>
                        </div>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="btn d-grid gap-2 btn-join-now mt-3 py-2">
                        Login or Register to Join
                    </a>
                @endguest
                </div>
            </div>
            </div>
        </div>
        </section>
    </main>
@endsection

@push('prepend-style')
    <!-- X-Zooom -->
    <link rel="stylesheet" href="{{ url('frontend/libraries/xZoom/xzoom.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xZoom/xzoom.min.js') }}"></script>
    <script>
    $(document).ready(function () {
        $(".xzoom, .xzoom-gallery").xzoom({
        zoomWidth: 500,
        title: false,
        tint: "#333",
        xoffset: 15,
        });
    });
    </script>
@endpush