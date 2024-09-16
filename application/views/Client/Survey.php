<style>
    .survey-container {
        max-width: 800px;
        margin: auto;
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .survey-header {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }
</style>

<div class="content-wrapper bg-white">

    <div class="content-header">
        <div class="container">
        </div>
    </div>

    <section class="content ">
        <div class="container-fluid">
            <div class="survey-container">
                <div class="card-body">
                    <div class="survey-header text-center fontpoppins">
                        <h2>We Value Your Feedback!</h2>
                        <p>Please help us improve our products, treatments, or services by filling out this survey.</p>
                    </div>
                    <div class="form-group fontpoppins">
                        <label for="survey_type">Which aspect would you like to review?</label>
                        <select class="form-control form-control-sm input-area" id="survey_type" name="survey_type" required>
                            <option value="" selected>Select an option</option>
                            <option value="Product">1 - Product</option>
                            <option value="Treatment">2 - Treatment</option>
                            <option value="Service">3 - Service</option>
                        </select>
                    </div>
                    <div class="form-group fontpoppins">
                        <label for="experience">How satisfied are you with the selected aspect?</label>
                        <select class="form-control form-control-sm input-area" id="experience" name="experience" required>
                            <option value="" selected>Select an option</option>
                            <option value="Very Satisfied">1 - Very Satisfied</option>
                            <option value="Satisfied">2 - Satisfied</option>
                            <option value="Neutral">3 - Neutral</option>
                            <option value="Dissatisfied">4 - Dissatisfied</option>
                            <option value="Very Dissatisfied">5 - Very Dissatisfied</option>
                        </select>
                    </div>
                    <div class="form-group fontpoppins">
                        <label for="improvement">How can we improve?</label>
                        <textarea class="form-control" id="improvement" name="improvement" rows="4" required></textarea>
                    </div>
                    <div class="form-group fontpoppins">
                        <label for="comments">Any additional comments or suggestions?</label>
                        <textarea class="form-control" id="comments" name="comments" rows="4" required></textarea>
                    </div>
                    <button type="submit" id="submit_survey" class="btn btn-sm btn-outline-primary float-right fontpoppins">Submit Survey</button>
                </div>
            </div>
        </div>
    </section>
</div>