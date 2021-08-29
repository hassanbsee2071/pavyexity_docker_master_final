<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PayVexity Invocie</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                {{-- <img src="" style="width:100%; max-width:300px;"> --}}
                            </td>
                            
                            <td>
                                Invoice #: {{ $invoice_number }}<br>
                                Created: {{ $invoice_date }}<br>
                                Due: {{ $due_date }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                              
                                Email : {{ $company_data->email }}<br>
                                Phone : {{ $company_data->phone }}
                            </td>
                            
                            <td>
                                {{ isset($user_info->first_name) ? $user_info->first_name : '' }} {{ isset($user_info->last_name) ? $user_info->last_name : '' }}.<br>
                                Email :{{ isset($user_info->email) ? $user_info->email : '' }} {{ isset($user_email) ? $user_email : '' }}<br>
								{{ isset($user_info->phone) ? "Phone:" :  '' }} {{ isset($user_info->phone) ? $user_info->phone : '' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th>
                  Description: {{ $invoice_title }}
                </th>
            </tr>           
            <tr class="heading">
                <td>
                    item
                </td>
                <td>
                    quantity
                </td>
                <td>
                    rate
                </td>
                <td>
                    Amount
                </td>
            </tr>
            <?php 
            $items = json_decode($jsondata,true);
            $cnt = count($items['content']['item']);
            for ($i=0; $i < $cnt ; $i++) { ?>                
                <tr class="item">
                 <td>
                    <?=$items['content']['item'][$i];?>
                </td>
                <td>
                    <?=$items['content']['quantity'][$i];?>
                </td> 
                <td>
                    <?=$items['content']['rate'][$i];?>
                </td> 
                <td>
                    <?=$items['content']['amounts'][$i];?>
                </td> 
            </tr>
            <?php }?>
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                    <th>
                        Total:  ${{ $invoice_amount }}
                    </th>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>