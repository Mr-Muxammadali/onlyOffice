<!doctype html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>User kabineti</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Inter, system-ui, sans-serif;
            background: #f3f4f6;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .title {
            margin-top: 0;
            font-size: 28px;
            font-weight: 700;
            text-align: center;
        }

        .info-box {
            background: #fafafa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 28px;
            border: 1px solid #e5e7eb;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #e5e7eb;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        input[type="text"] {
            padding: 10px 14px;
            font-size: 15px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            width: 100%;
            transition: 0.2s;
        }

        input.error {
            border-color: #dc3545 !important;
            background: #fff5f5;
        }

        button {
            padding: 10px 16px;
            background: #2563eb;
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 130px;
            transition: .15s ease;
        }

        button:hover {
            background: #1e40af;
        }
    </style>
</head>

<body>

<div class="container">
    <h1 class="title">User kabineti</h1>

    {{-- Success / Error alert --}}
    @if(session('success') !== null)
        @if(session('success'))
            <div class="alert alert-success">Transfer muvaffaqiyatli amalga oshirildi!</div>
        @else
            <div class="alert alert-danger">Xatolik yuz berdi!</div>
        @endif
    @endif


    {{-- Validation alerts --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <strong>Xatolik!</strong> {{ $error }}
            </div>
        @endforeach
    @endif


    <div class="info-box">
        <div class="info-row">
            <div>ID:</div>
            <div>{{ $user->id }}</div>
        </div>

        <div class="info-row">
            <div>Name:</div>
            <div>{{ $user->name }}</div>
        </div>

        <div class="info-row">
            <div>Email:</div>
            <div>{{ $user->email }}</div>
        </div>

        <div class="info-row">
            <div>Balance:</div>
            <div>{{ number_format($user->balance, 2) }} so‘m</div>
        </div>
    </div>

    <form action="{{route('transfer')}}" method="POST" novalidate >
        @csrf

        <input type="hidden" name="id" value="{{ $user->id }}">

        {{-- Amount input --}}
        <input
            type="text"
            name="amount"
            placeholder="Summani kiriting"
            value="{{ old('amount') }}"
            class="@error('amount') error @enderror"
        >

        @error('amount')
        <p class="text-danger mt-1 mb-2">{{ $message }}</p>
        @enderror

        <div class="text-center mt-3">
            <button type="submit">Send</button>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
