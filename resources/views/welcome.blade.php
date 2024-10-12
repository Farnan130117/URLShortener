<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Welcome')

<style>
    .custom-list ul {
        max-width: 500px;
        padding: 0;
        margin: 20px 0;
        list-style-type: none; /* Remove bullet points */
    }

    .custom-list li {
        display: flex; /* Add flexbox to li */
        justify-content: space-between; /* Space the URL and Copy button */
        align-items: center; /* Center the items vertically */
        margin: 10px 0; /* Space between list items */
    }

    .custom-list a {
        display: flex; /* Flexbox layout for URL link */
        align-items: center; /* Center align items vertically */
        text-decoration: none; /* Remove underline */
        color: #000; /* Set text color */
        background-color: #eee; /* Light background for the entire link */
        padding: 1em; /* Padding around the link */
        flex-grow: 1; /* Make the link take up the remaining space */
        transition: background-color 0.3s ease; /* Smooth transition on hover */
        margin-right: 10px; /* Add space between the URL and Copy button */
    }

    .custom-list a:hover {
        background-color: #ddd; /* Darker background on hover */
    }

    .custom-list .date {
        background-color: #333; /* Set the background for the date */
        color: #fff; /* White text color */
        padding: 0.5em; /* Padding for the date span */
        margin-right: 10px; /* Space between the date and text */
        min-width: 100px; /* Ensure a fixed width for the date */
        text-align: center; /* Center the text */
    }

    .copy-btn {
        background-color: #000000;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 3px;
    }

    .copy-btn:hover {
        background-color: #4b5563;
    }

</style>
@section('content')
    <section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <article class="featured-post">
                        <div class="featured-post-content">
                            <div class="featured-post-author">
                                <img src="{{ asset('frontend/images/author.jpeg') }}" alt="author" />
                                <p>By <span>Md Mokammal Hossen Farnan</span></p>
                            </div>
                            <a href="#" class="featured-post-title">
                                GET YOUR LONG URL SHORT WITH ANALYTICS
                            </a>
                            <ul class="featured-post-meta">
                                <li>
                                    <i class="fa fa-mail-forward"></i>
                                    mh.farnan@gmail.com
                                </li>
                            </ul>
                        </div>
                        <div class="featured-post-thumb">
                            <img src="{{ asset('frontend/images/featured-post.jpg') }}" alt="feature-post-thumb" />
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-section-title">
                        <h2>Latest Shorten URLs</h2>
                        <p>View the latest short urls</p>
                    </div>
                    <article class="custom-list">
                        <div>
                            <ul id="short-urls-list">
                                @foreach($shortUrls as $url)
                                    <li>
                                        <a href="{{ $url->short_code }}" target="_blank">
                                            <span class="date">{{ $url->short_code }}</span>
{{--                                            {{ $url->long_url }}--}}
                                            {{ url($url->short_code) }}

                                        </a>
                                        <button class="copy-btn" data-url="{{ url($url->short_code) }}"><i class="fa fa-file"></i></button>

                                    </li>
                                @endforeach
                            </ul>

                            <!-- Load More Button -->
                        @if($shortUrls->count() == 5) <!-- Only show the button if there are at least 5 items -->
                            <button id="load-more-btn" data-offset="5" class="btn btn-primary">Load More</button>
                            @endif
                        </div>
                    </article>

                </div>
                <div class="col-lg-4">
                    <div class="blog-post-widget">
                        <div class="latest-widget-title">
                            <h2>Trending URLs</h2>
                        </div>
                        @foreach($trendingUrls as $url)
                        <div class="latest-widget">
                            <div class="latest-widget-thum">
                                <a href="#">
                                    <img src="{{ asset('frontend/images/blog/blog-thum-1.jpg') }}" alt="blog-thum" />
                                </a>
                                <div class="icon">
                                    <a href="#">
                                        <img src="{{ asset('frontend/images/blog/icon.svg') }}" alt="icon" /></a>
                                </div>
                            </div>
                            <div class="latest-widget-content">
                                <div class="content-title">
                                    <a href="{{ url($url->short_code) }}" target="_blank">{{ $url->short_code }}</a>
                                </div>
                                <div class="content-meta">
                                    <ul>
                                        <li>
                                            <i class="fa fa-line-chart"></i>
                                             ({{ $url->click_count }} clicks)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
       document.getElementById('load-more-btn').addEventListener('click', function() {
           let button = this;
           let offset = parseInt(button.getAttribute('data-offset')); // Get the current offset
           let limit = 5; // The number of URLs to load per request

           // Fetch more URLs
           fetch(`/load-more-urls?offset=${offset}&limit=${limit}`)
               .then(response => response.json())
               .then(data => {
                   console.log('Data received:', data); // Log the data to inspect it

                   if (data.length > 0) {
                       // Append the new URLs to the list
                       let urlList = document.getElementById('short-urls-list');
                       data.forEach(url => {
                           let newUrl = `
                        <li>
                            <a href="${url.short_code}" target="_blank">
                                <span class="date">${url.short_code}</span>
                           <!-- ${url.long_url} -->
                               ${window.location.origin}/${url.short_code}
                            </a>
                           <button class="copy-btn" data-url="${window.location.origin}/${url.short_code}">
                           <i class="fa fa-file"></i>
                           </button>
                        </li>
                    `;
                           urlList.insertAdjacentHTML('beforeend', newUrl);
                       });

                       // Update the offset for the next batch
                       button.setAttribute('data-offset', offset + limit);
                   } else {
                       // Hide the "Load More" button if no more data is available
                       console.log('No more URLs to load.');
                       button.style.display = 'none';
                   }
               })
               .catch(error => {
                   console.error('Error fetching more URLs:', error);
               });
       });
   </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Bind event listener to dynamically added content
            document.addEventListener('click', function (e) {
                // Check if the clicked element has the 'copy-btn' class
                if (e.target && e.target.closest('.copy-btn')) {
                    // Get the URL from the data attribute
                    const copyButton = e.target.closest('.copy-btn');
                    const urlToCopy = copyButton.getAttribute('data-url');

                    // Use the modern Clipboard API to copy text
                    navigator.clipboard.writeText(urlToCopy).then(() => {
                        // Success feedback (optional)
                        alert('URL copied to clipboard: ' + urlToCopy);
                    }).catch(err => {
                        // Handle error if the browser does not support this feature
                        console.error('Could not copy text: ', err);
                    });
                }
            });
        });


    </script>




@endsection
