<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ការគណនាកម្ចី</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;700&display=swap');

        :root {
            --smoky-bg: #e0eafc; /* ពណ៌ផ្ទៃខាងក្រោយស្រាល */
            --glass-bg: rgba(255, 255, 255, 0.4); /* ពណ៌ថ្លា */
            --text-color: #4a4a4a;
            --accent-green: #a8e6cf; /* ពណ៌បៃតងដូចផ្សែង */
            --accent-green-dark: #10975f;
        }

        body {
            font-family: 'Kantumruy Pro', sans-serif;
            font-weight: 300;
            color: var(--text-color);
            background-color: var(--smoky-bg);
            /* បន្ថែមរូបភាពផ្សែងជា background (ស្រេចចិត្ត) */
            background-image: 
                radial-gradient(at 10% 20%, rgba(200, 230, 240, 0.3) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(180, 210, 230, 0.3) 0px, transparent 50%);
            min-height: 100vh;
        }

        /* ស្ទីលបែប Glassmorphism សម្រាប់ Card */
        .card-smoky {
            background: var(--glass-bg);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px); /* ធ្វើឱ្យព្រិល */
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            color: var(--text-color);
            transition: transform 0.2s ease-in-out;
        }

        .card-smoky:hover {
            transform: translateY(-2px);
        }

        h4, h5 {
            font-weight: 400;
            letter-spacing: 1px;
        }

        .text-smoky-primary {
            color: #5d8aa8; /* ពណ៌ខៀវប្រផេះ */
        }

        /* ស្ទីលសម្រាប់ Input */
        .form-control {
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: var(--text-color);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.5);
            border-color: var(--accent-green);
            box-shadow: 0 0 10px var(--accent-green);
        }

        /* ស្ទីលប៊ូតុង */
        .btn-smoky {
            background-color: var(--accent-green);
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(168, 230, 207, 0.4);
        }

        .btn-smoky:hover {
            background-color: var(--accent-green-dark);
            box-shadow: 0 6px 20px rgba(168, 230, 207, 0.6);
            transform: scale(1.02);
            color: #fff;
        }

        /* ស្ទីលសម្រាប់តារាង */
        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table {
            background: transparent;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table-header {
            background: rgba(168, 230, 207, 0.5) !important; /* ពណ៌បៃតងថ្លា */
            color: var(--text-color) !important;
            font-weight: 400;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            background-color: rgba(255, 255, 255, 0.1); /* ជួរឆ្លាស់ */
        }

        .table td, .table th {
            border-color: rgba(255, 255, 255, 0.08) !important;
            padding: 12px;
            vertical-align: middle;
        }

        .summary-box {
            background: rgba(168, 230, 207, 0.2);
            border-radius: 10px;
            padding: 15px;
            border: 1px solid rgba(168, 230, 207, 0.3);
        }
    </style>
</head>
<body class="p-3 p-md-5">

<div class="container" style="max-width: 950px;">
    <div class="card card-smoky p-4 mb-4">
        <h4 class="mb-4 text-smoky-primary text-center">ការគណនាកម្ចី (Loan calculator)</h4>
        
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">ទំហំឥណទាន ($)</label>
                    <input type="number" step="any" name="amount" class="form-control" placeholder="ឧ. 1000" required value="<?= $_POST['amount'] ?? '' ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">អត្រាការប្រាក់ (%/ខែ)</label>
                    <input type="number" step="any" name="rate" class="form-control" placeholder="ឧ. 1" required value="<?= $_POST['rate'] ?? '' ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">រយៈពេល (ឆ្នាំ)</label>
                    <input type="number" name="years" class="form-control" placeholder="ឧ. 1" required value="<?= $_POST['years'] ?? '' ?>">
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" name="calculate" class="btn btn-smoky">គណនា/Calculate</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['calculate'])) {
        $loan_amount = floatval($_POST['amount']);
        $monthly_rate = floatval($_POST['rate']) / 100;
        $total_months = intval($_POST['years']) * 12;
        $start_date = "2026-05-01";

        if ($total_months <= 0 || $loan_amount <= 0) {
             echo "<div class='alert alert-danger text-center'>សូមបញ្ចូលទិន្នន័យឱ្យបានត្រឹមត្រូវ។</div>";
        } else {
            // រូបមន្ត PMT
            if ($monthly_rate > 0) {
                $monthly_payment = ($loan_amount * $monthly_rate) / (1 - pow(1 + $monthly_rate, -$total_months));
            } else {
                $monthly_payment = $loan_amount / $total_months;
            }
    ?>

    <div class="card card-smoky p-4">
        <h5 class="mb-4 text-smoky-primary">Summary</h5>
        <div class="summary-box mb-4">
            <div class="row">
                <div class="col-sm-6 mb-2">
                    <p class="m-0"><strong>ទំហំឥណទាន:</strong> $<?= number_format($loan_amount, 2) ?></p>
                    <p class="m-0"><strong>អត្រាការប្រាក់:</strong> <?= $_POST['rate'] ?>%</p>
                    <p class="m-0"><strong>រយៈពេល:</strong> <?= $_POST['years'] ?> ឆ្នាំ (<?= $total_months ?> ដង)</p>
                </div>
                <div class="col-sm-6 text-sm-end">
                    <p class="m-0"><strong>បង់ប្រចាំខែចំនួន:</strong> $<?= number_format($monthly_payment, 2) ?></p>
                    <p class="m-0"><strong>ការបង់ដំបូងបង្អស់:</strong> <?= $start_date ?></p>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover text-center">
                <thead class="table-header">
                    <tr>
                        <th>ល.រ</th>
                        <th>កាលបរិច្ឆេទ</th>
                        <th>ទំហំឥណទាន</th>
                        <th>ការប្រាក់</th>
                        <th>បង់ប្រចាំខែ</th>
                        <th>ប្រាក់ដើម</th>
                        <th>កម្ចីនៅសល់</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $current_balance = $loan_amount;
                    $total_interest = 0;

                    for ($i = 1; $i <= $total_months; $i++) {
                        $interest = $current_balance * $monthly_rate;
                        $principal = $monthly_payment - $interest;
                        $remaining = $current_balance - $principal;
                        $total_interest += $interest;

                        echo "<tr>
                                <td>$i</td>
                                <td>" . date('Y-m-d', strtotime($start_date . " + " . ($i-1) . " month")) . "</td>
                                <td>$" . number_format($current_balance, 2) . "</td>
                                <td>$" . number_format($interest, 2) . "</td>
                                <td>$" . number_format($monthly_payment, 2) . "</td>
                                <td>$" . number_format($principal, 2) . "</td>
                                <td>$" . number_format(abs($remaining) < 0.001 ? 0 : $remaining, 2) . "</td>
                              </tr>";

                        $current_balance = $remaining;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4 p-3 summary-box text-end">
            <h6 class="m-0 text-dark">សរុបការប្រាក់ត្រូវបង់: $<?= number_format($total_interest, 2) ?></h6>
        </div>
    </div>
    <?php } // បិទ if logical checks
    } // បិទ isset calculate ?>
</div>

</body>
</html>
