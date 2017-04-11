
<div style="position:absolute;width:100vw;margin-top:50px;">
  <div  class="row col m4 offset-m4 card-panel white">

    <div class="col m2 offset-m2">
      <img width="100%" src="<?php echo $UI . 'img/osa-logo.png'; ?>"><br/>
      <img width="100%" src="<?php echo $UI . 'img/uplb-logo.png'; ?>">
    </div>

    <div class="col m5 center-align">
      <h5 style="font-size:15px;">Welcome to the<br/>
          <span style="font-size:30px;line-height:30px;font-style:bold;">
          University<br/> 
          <span style="font-size:45px;line-height:45px;"><strong>Job Fair</strong></span><br/> 
          2016
          </span>
      </h5>
    </div>

    <form class="col s12" id="job-fair-form">
      <p class="col m12">
        Please fill out the fields below.
      </p>
      <div class="row">


        <?php $ctr=0; foreach (($inputs?:array()) as $input): $ctr++; ?>

          <div class="input-field col s12">

            <?php if ($ctr==1): ?>
                
                    <input id="<?php echo $input['id']; ?>" type="text" class="job-fair-input validate" autofocus>
                
                <?php else: ?>
                    <input id="<?php echo $input['id']; ?>" type="text" class="job-fair-input validate" >
                
            <?php endif; ?>

            <label class="label" for="<?php echo $input['id']; ?>"><?php echo $input['label']; ?></label>
          </div>

        <?php endforeach; ?>





        <div class="input-field col s12">
          <a class="waves-effect waves-light btn" id="submit"><i class="material-icons left">done</i>submit</a>
        </div>
      </div>
      
    </form>
  </div>

</div>