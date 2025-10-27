@extends('backend.layouts.app')
@section('content')

    <style>
        .custom-card {
            background-color: rgba(0, 0, 0, 0.9) !important;
            border-radius: 1rem;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.2s linear !important;
            padding: 1.3rem;
            max-height: 16vh;
        }

        .custom-card:hover {
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3) !important;
            transition: all 0.2s linear !important;
            transform: translateY(4px);
            cursor: pointer;
        }

        .custom-card2 {
            background-color: rgba(248, 246, 246, 0.941) !important;
            border-radius: 1rem;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.2s linear !important;
            padding: 1.3rem;
            max-height: 16vh;
        }

        .custom-card2:hover {
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.2s linear !important;
            transform: translateY(4px);
            cursor: pointer;
        }

        .custom-card .card-body h6 {
            color: #f5f5f5;
        }

        .custom-card .card-body .custom-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--theme-text-white) !important;
        }

        .custom-card .custom-active {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #27ae60 !important;

            display: flex;
            justify-content: center;
            align-items: center;
            color: #f5f5f5;
        }

        .custom-card .custom-inactive {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #e67e22 !important;

            display: flex;
            justify-content: center;
            align-items: center;
            color: #f5f5f5;
        }
    </style>

    <div class="row my-4 row-gap-2">
        <div class="col-lg-3">
            <a href="{{ route('course.index') }}" target="_blank">
                <div class="custom-card d-flex justify-content-between">
                    <div class="card-body">
                        <h6 class="card-title">Courses</h6>
                        <p class="card-text custom-text mt-1">{{ $totalCourses }}</p>

                        <div class="custom-active-inactive d-flex justify-content-start align-items-center column-gap-2">
                            <p class="custom-active"></p>
                            <div class="text-white">{{ $activeCourses }}</div>
                            <p class="custom-inactive"></p>
                            <div class="text-white">{{ $inactiveCourses }}</div>
                        </div>
                    </div>

                    <div class="card-icon">
                        <i class="fa-solid fa-book fa-2x text-white"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{ route('category.index') }}" target="_blank">
                <div class="custom-card d-flex justify-content-between">
                    <div class="card-body">
                        <h6 class="card-title">Categories</h6>
                        <p class="card-text custom-text mt-1">{{ $totalCategories }}</p>

                        <div class="custom-active-inactive d-flex justify-content-start align-items-center column-gap-2">
                            <p class="custom-active"></p>
                            <div class="text-white">{{ $activeCategories }}</div>
                            <p class="custom-inactive"></p>
                            <div class="text-white">{{ $inactiveCategories }}</div>
                        </div>
                    </div>

                    <div class="card-icon">
                        <i class="fa-solid fa-tags fa-2x text-white"></i>
                    </div>
                </div>
            </a>
        </div>

        {{-- <div class="col-lg-3">
            <a href="{{ route('user.index') }}" target="_blank">
                <div class="custom-card d-flex justify-content-between">
                    <div class="card-body">
                        <h6 class="card-title">Users</h6>
                        <p class="card-text custom-text mt-1">{{ $totalUsers }}</p>

                        <div class="custom-active-inactive d-flex justify-content-start align-items-center column-gap-2">
                            <p class="custom-active"></p>
                            <div class="text-white">{{ $activeUsers }}</div>
                            <p class="custom-inactive"></p>
                            <div class="text-white">{{ $inactiveUsers }}</div>
                        </div>
                    </div>

                    <div class="card-icon">
                        <i class="fa-solid fa-user fa-2x text-white"></i>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>

    <div class="row row-gap-2">
        <div class="col-lg-12">
            <nav class="navbar bg-body-tertiary mb-3">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <strong>Latest Courses</strong>
                    </a>
                </div>
            </nav>
            @foreach ($courses as $course)
                <a href="{{ route('course.show', $course->id) }}" target="_blank">
                    <div class="custom-card2 d-flex justify-content-between align-items-center mb-3">
                        <div class="custom-active-inactive">
                            <strong>{{ $course->title }}</strong> <br>
                            {{ strip_tags(Illuminate\Support\Str::limit($course->description, 40)) }} <br>
                            <small class="text-success">{{ $course->created_at->toDayDateTimeString() }}</small>
                        </div>

                        <div class="card-icon">
                            @if($course->status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-warning">Inactive</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endpush
