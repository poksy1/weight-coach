<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Profil - Weight Coach</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 fw-bold">Lengkapi Profil Fisikmu</h3>
                    
                    <form method="POST" action="{{ route('profile.store') }}">
                        @csrf <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Berat Badan (kg)</label>
                                <input type="number" step="0.1" name="weight" class="form-control" required placeholder="Cth: 65.5">
                            </div>
                            <div class="col">
                                <label class="form-label">Target Berat (kg)</label>
                                <input type="number" step="0.1" name="target_weight" class="form-control" required placeholder="Cth: 60.0">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" name="height" class="form-control" required placeholder="Cth: 170">
                            </div>
                            <div class="col">
                                <label class="form-label">Usia</label>
                                <input type="number" name="age" class="form-control" required placeholder="Cth: 20">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-select" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Simpan Profil & Mulai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>