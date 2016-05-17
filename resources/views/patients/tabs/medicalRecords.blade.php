<div class="container-fluid margin" ng-controller="RecordController">

    {{-- Initialize the angular variables in a hidden field --}}
    <input type="hidden"
           ng-init="baseUrl='{{url("/")}}';id={{$patient->id}};token='{{csrf_token()}}';loadMedicalRecords()">

    <div class="alert alert-success alert-dismissable" ng-show="hasSuccess" ng-cloak>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        [[successMessage]]
    </div>

    <div class="row margin">
        <label class="control-label col-md-4 col-md-offset-4 text-left">Search (by dianosis,date and etc...)</label>
        <div class="col-md-4">
            <input type="text" ng-model="searchText" class="form-control">
        </div>
    </div>

    {{-- Info message if there are no prescriptions to be issued --}}
    <div class="alert alert-info alert-dismissable" ng-if="prescriptions.length==0" ng-cloak>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Sorry!</h4>
        No medical record to be displayed for this patient.
    </div>

    {{--Prescription--}}
    <div class="box box-primary box-solid"
         ng-repeat="prescription in prescriptions | filter:searchText">
        <div class="box-header">
            <h4 class="box-title">
                [[prescription.created_at | dateToISO | date:"EEEE, d/M/yy h:mm a"]]
            </h4>
        </div>

        <div class="box-body">

            <div class="alert alert-danger alert-dismissable" ng-show="prescription.hasError" ng-cloak>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                [[error]]
            </div>

            <div class="row">
                <label class="col-md-4">Complaints</label>
                <div class="col-md-8">[[prescription.complaints]]</div>
            </div>

            <div class="row">
                <label class="col-md-4">Investigations</label>
                <div class="col-md-8">[[prescription.investigations]]</div>
            </div>

            <div class="row">
                <label class="col-md-4">Diagnosis</label>
                <div class="col-md-8">[[prescription.diagnosis]]</div>
            </div>

            <div class="row">
                <label class="col-md-4">Remarks</label>
                <div class="col-md-8">[[prescription.remarks]]</div>
            </div>

            <br>

            <table class="table table-hover table-condensed table-bordered table-striped text-center">
                <thead>
                <tr class="success">
                    <th class="col-sm-4">Drug</th>
                    <th class="col-sm-5">Dose</th>
                    <th class="col-sm-3">Quantity</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="prescribedDrug in prescription.prescription_drugs" class="success">
                    <td>[[prescribedDrug.drug.name]] ([[prescribedDrug.drug.quantity_type.drug_type]])</td>
                    <td>
                        [[prescribedDrug.dosage.description]]<br>
                        [[prescribedDrug.frequency.description]]<br>
                        [[prescribedDrug.period.description]]
                    </td>
                    <td>
                        [[prescribedDrug.quantity]]
                    </td>
                </tr>
                </tbody>
            </table>

            <br>

            <div class="row">
                <label class="col-md-4">Payment</label>
                <div class="col-md-8">[[prescription.payment.amount]]</div>
            </div>

            <div class="row">
                <label class="col-md-4">Remarks on Payment</label>
                <div class="col-md-8">[[prescription.payment.remarks]]</div>
            </div>

        </div>
    </div>


</div>