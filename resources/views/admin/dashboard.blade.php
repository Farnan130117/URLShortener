<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

<style>
    .scrollable-table {
        max-height: 260px; /* Adjust height as needed */
        overflow-y: auto;
    }

    .scrollable-table table {
        width: 100%;
    }

</style>
@section('content')
    <!-- main content- start -->
    <div class="main-panel" >
        <div class="content" >
            <div class="container-fluid">

                <h4 class="page-title">Forms</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">List of Shortened URLs</div>
                            </div>
                            <div class="card-body">
                                <!-- Add table-responsive class here -->
                                <div class="table-responsive">
                                    <table id="shortenedUrlsTable" class="table table-striped display">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Long URL</th>
                                            <th>Short URL</th>
                                            <th>Expiration Date</th>
                                            <th>Analytics</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($shortUrls as $url)
                                            <tr>
                                                <td>{{ $url->id }}</td>
                                                <td>{{ $url->long_url }}</td>
                                                <td><a href="{{ url($url->short_code) }}" target="_blank">{{ url($url->short_code) }}</a></td>
                                                <td>{{ $url->expires_at ? date('Y-m-d', strtotime($url->expires_at)) : 'N/A' }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info view-analytics-btn" data-id="{{ $url->id }}" data-toggle="modal" data-target="#analyticsModal">
                                                        Insights
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- Close table-responsive div -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">URL Shortener Form</div>
                            </div>

                            <form id="urlShortenerForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Enter Long URL</label>
                                        <input type="url" class="form-control" name="long_url" required placeholder="Enter URL">
                                        <small id="emailHelp" class="form-text text-muted">Enter your original url here which you want to be shortened.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="expire_at">Expiration Date (optional):</label>
                                        <input type="date" class="form-control" name="expires_at" id="expires_at">
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success" type="submit">Shorten</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    {{--                    <div class="col-md-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <div class="card-title">URL shortner Form</div>--}}
{{--                            </div>--}}

{{--                            <form method="POST" action="{{ route('shorten') }}">--}}
{{--                                @csrf--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="email">Enter Long URL</label>--}}
{{--                                    <input type="url" class="form-control" name="long_url" required placeholder="Enter URL">--}}
{{--                                    <small id="emailHelp" class="form-text text-muted">Enter your original url here which you want to be short.</small>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="expire_at">Expiration Date (optional):</label>--}}
{{--                                    <input type="date" class="form-control"  name="expires_at" id="expires_at">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-action">--}}
{{--                                <button class="btn btn-success" type="submit">Shorten</button>--}}
{{--                            </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
        </div>
    </div>

    <!-- main content- end -->
{{--    <h1>Admin Dashboard</h1>--}}

{{--    <!-- Success message -->--}}
{{--    @if (session('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <!-- Table to display short URLs -->--}}
{{--    <table>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Short URL</th>--}}
{{--            <th>Long URL</th>--}}
{{--            <th>Clicks</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($shortUrls as $url)--}}
{{--            <tr>--}}
{{--                <td>{{ url('/' . $url->short_code) }}</td>--}}
{{--                <td>{{ $url->long_url }}</td>--}}
{{--                <td>{{ $url->clicks_count }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <form method="POST" action="{{ route('shorten') }}">--}}
{{--        @csrf--}}
{{--        <input type="url" name="long_url" required placeholder="Enter URL">--}}


{{--        <label for="expire_at">Expiration Date (optional):</label>--}}
{{--        <input type="date" name="expire_at" id="expire_at">--}}

{{--        <button type="submit">Shorten</button>--}}


{{--        @if ($errors->has('error'))--}}
{{--            <span class="text-danger">{{ $errors->first('error') }}</span>--}}
{{--        @endif--}}


{{--        @error('long_url')--}}
{{--        <span class="text-danger">{{ $message }}</span>--}}
{{--        @enderror--}}


{{--        @error('expire_at')--}}
{{--        <span class="text-danger">{{ $message }}</span>--}}
{{--        @enderror--}}
{{--    </form>--}}


    <!-- Modal -->
    <div class="modal fade" id="analyticsModal" tabindex="-1" role="dialog" aria-labelledby="analyticsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="analyticsModalLabel">URL Analytics</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add a wrapper with a fixed height and overflow for scroll -->
                    <div id="analytics-data" class="scrollable-modal-content">
                        <p>Loading...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <!-- Initialize DataTable -->
    <script>
        // $(document).ready(function() {
        //     $('#shortenedUrlsTable').DataTable({
        //         "paging": true,
        //         "ordering": true,
        //         "searching": true,
        //         "info": true
        //     });
        // });
        $(document).ready(function() {
            var table = $('#shortenedUrlsTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "info": true,
                "order": [[0, 'desc']],
            });

            $('#urlShortenerForm').on('submit', function(e) {
                e.preventDefault();

                // Serialize form data
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('shorten') }}", // Route to handle form submission
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        // On success, append the new data to the table
                        var newRow = [
                            response.id,
                            response.long_url,
                            `<a href="${response.short_url}" target="_blank">${response.short_code}</a>`,
                            response.created_at,
                            response.expires_at ? response.expires_at : 'N/A'
                        ];

                        // Add the new row to the DataTable
                        table.row.add(newRow).draw(false);
                        // To ensure the new row appears at the top, use order() to sort by ID in descending order
                        table.order([0, 'desc']).draw();  // Assuming the first column (index 0) is 'id'

                        // Clear the form fields
                        $('#urlShortenerForm')[0].reset();

                        // Optionally, show a success message
                        alert('Short URL created successfully!');
                    },
                    error: function(xhr) {
                        // Handle any validation errors or failures
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            alert(Object.values(errors).join("\n"));
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.view-analytics-btn').click(function() {
                var urlId = $(this).data('id'); // Get the ID of the short URL
                $('#analytics-data').html('<p>Loading...</p>'); // Show loading message

                $.ajax({
                    url: '/get-url-analytics/' + urlId, // Replace with your actual route
                    type: 'GET',
                    success: function(response) {
                        // Calculate total visitors, unique countries, and unique IP addresses
                        var totalVisitors = response.analytics.length;
                        var uniqueCountries = [...new Set(response.analytics.map(click => click.location))];
                        var uniqueIps = [...new Set(response.analytics.map(click => click.ip_address))].length;

                        // Find the latest visit
                        if (response.analytics.length > 0) {
                            var latestVisit = new Date(response.analytics[0].clicked_at); // Assuming the first one is the latest (sorted)
                            response.analytics.forEach(function(click) {
                                var clickDate = new Date(click.clicked_at);
                                if (clickDate > latestVisit) {
                                    latestVisit = clickDate;
                                }
                            });

                            // Calculate the time difference
                            var timeDifference = Math.floor((new Date() - latestVisit) / 1000); // Time difference in seconds

                            var minutes = Math.floor(timeDifference / 60);
                            var hours = Math.floor(timeDifference / 3600);
                            var days = Math.floor(timeDifference / 86400);

                            var latestVisitText;
                            if (minutes < 1) {
                                latestVisitText = "just now";
                            } else if (minutes < 60) {
                                latestVisitText = minutes + " minutes ago";
                            } else if (hours < 24) {
                                latestVisitText = hours + " hours ago";
                            } else {
                                latestVisitText = days + " days ago";
                            }
                        } else {
                            var latestVisitText = "No visits yet";
                        }

                        // Create the summary
                        var summaryHtml = `
                   <!-- <p><strong>Total Visitors:</strong> ${totalVisitors}</p> -->
                   <!-- <p><strong>Unique Countries:</strong> ${uniqueCountries.length}</p> -->
                   <!-- <p><strong>Unique IP Addresses:</strong> ${uniqueIps}</p> -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-stats card-warning">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="icon-big text-center">
                                                <i class="la la-users"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Visitors</p>
                                                <h4 class="card-title">${totalVisitors}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-stats card-success">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="icon-big text-center">
                                                <i class="la la-bar-chart"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Countries</p>
                                                <h4 class="card-title">${uniqueCountries.length}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-stats card-danger">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="icon-big text-center">
                                                <i class="la la-newspaper-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">Unique IPs</p>
                                                <h4 class="card-title">${uniqueIps}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-stats card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="icon-big text-center">
                                                <i class="la la-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 d-flex align-items-center">
                                            <div class="numbers">
                                                <p class="card-category">LATEST VISIT</p>
                                              <!--  <h4 class="card-title">${latestVisitText}</h4> -->
                                              <h4 class="card-title" style="white-space: nowrap;">${latestVisitText}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                        // Create the table with click data
                        var tableHtml = `
                    <div class="scrollable-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Clicked At</th>
                                    <th>IP Address</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                        response.analytics.forEach(function(click) {
                            tableHtml += `
                        <tr>
                            <td>${click.clicked_at}</td>
                            <td>${click.ip_address}</td>
                            <td>${click.location}</td>
                        </tr>
                    `;
                        });

                        tableHtml += '</tbody></table></div>';

                        if (response.analytics.length === 0) {
                            tableHtml = '<p>No clicks recorded yet.</p>';
                        }

                        // Create the table for unique countries
                        var countryTableHtml = `
                    <div class="scrollable-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                        uniqueCountries.forEach(function(country) {
                            countryTableHtml += `<tr><td>${country}</td></tr>`;
                        });

                        countryTableHtml += '</tbody></table></div>';

                        // Insert the summary, click data table, and country table into the modal
                        $('#analytics-data').html(summaryHtml + tableHtml + '<h5>Visited Countries</h5>' + countryTableHtml);
                    },
                    error: function() {
                        $('#analytics-data').html('<p>Error loading data. Please try again.</p>');
                    }
                });
            });
        });





    </script>
@endsection



