<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        .certificate-body {
            height: 600px !important;
            width: 930px !important;
            background-image: url('{{ public_path($certificate?->background) }}');
            background-size: cover;
            background-position: center;
            text-align: center
        }

        body {
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 0;
            size: 930px 600px;
        }

        .certificate-body div {
            /* display: inline-block; */
            position: relative;
        }

        .certificate-body .title {
            font-size: 20px;
            font-weight: 600;
        }

        .certificate-body .subtitle {
            font-size: 18px;
            font-weight: 400;
        }

        .certificate-body .signature img {
            width: 120px;
            height: 100px;
        }

        @foreach ($certificateItems as $item)
            #{{ $item->element_id }} {
                left: {{ $item->x_position }}px;
                top: {{ $item->y_position }}px;
            }
        @endforeach;
    </style>
</head>

<body>
    <div class="certificate-body">
        <div id="title" class="title draggable-element">{{ $certificate?->title }}</div>
        <div id="subtitle" class="subtitle draggable-element">{{ $certificate?->subtitle }}</div>
        <div id="description" class="description draggable-element">{!! $certificate?->description !!}</div>
        <div id="signature" class="signature draggable-element">
            <img src="{{ public_path($certificate?->signature) }}" alt="">
        </div>
    </div>
</body>

</html>
