<div class="col-lg-6 col-12">
    <div class="float-right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addIncome">
            Add Income
        </button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addSpending">
            Add Spending
        </button>

        <!-- Modal For Add Income -->
        <div class="modal fade" id="addIncome" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Income</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="incomeDatepicker"
                                               class="required-input">Date</label>
                                        <input type="text" class="form-control"
                                               id="incomeDatepicker"
                                               placeholder="Date" name="incomeDate" autocomplete="off" required/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="incomeCategory">Category</label>
                                        <select class="form-control" id="incomeCategory"
                                                name="incomeCategory">
                                            <option value="">-- Uncategorized --</option>
                                            @foreach($categories as $category)
                                                <option>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group required">
                                        <label for="amount" class="required-input">Amount</label>
                                        <input class="form-control text-right" name="incomeAmount"
                                               type="number" data-parsley-maxlength="20" parsley-type="number"
                                               id="amount"
                                               required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="transactionDescription" class="required-input">Transaction
                                            Description</label>
                                        <textarea class="form-control" id="transactionDescription"
                                                  rows="4" name="incomeDescription" data-parsley-minlength="10"
                                                  data-parsley-maxlength="250" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"  name="submitIncome">Add Income</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancel
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Modal For Add Spending -->
        <div class="modal fade" id="addSpending" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Spending</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="spendingDatepicker"
                                               class="required-input">Date</label>
                                        <input type="text" class="form-control"
                                               id="spendingDatepicker"
                                               placeholder="Date" name="speandingDate" autocomplete="off" required/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="spendingCategory">Category</label>
                                        <select class="form-control" id="spendingCategory"
                                                name="spendingCategory">
                                            <option value="">-- Uncategorized --</option>
                                            @foreach($categories as $category)
                                                <option>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group required">
                                        <label for="spendingAmount" class="required-input">Amount</label>
                                        <input class="form-control text-right" name="spendingAmount"
                                               type="number" data-parsley-maxlength="20" parsley-type="number"
                                               id="spendingAmount"
                                               required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="spendingDescription" class="required-input">Transaction
                                            Description</label>
                                        <textarea class="form-control" id="spendingDescription"
                                                  rows="4" name="spendingDescription" data-parsley-minlength="10"
                                                  data-parsley-maxlength="250" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submitSpending">Add Spending</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancel
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
