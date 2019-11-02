<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Сборник задач</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="сборник задач, задачник"/>
        <meta name="description" content="Сборник задач"/>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-dark navbar-expand-sm bg-primary fixed-top">
            <div class="container">
              <span class="navbar-text">
                  <?php if ($user['admin']): ?>
                      <span><?= $user['admin'] ?></span>
                      <a data-toggle="modal" data-target="#logoutModal">
                      <span class="fa fa-sign-out"></span> Log out</a>
                  <?php else: ?>
                      <a data-toggle="modal" data-target="#loginModal">
                      <span class="fa fa-sign-in"></span> Login</a>
                  <?php endif; ?>
              </span>
            </div>
        </nav>
        <!-- Modal window login/logout -->
        <div id="loginModal" class="modal fade" role="dialog">
             <div class="modal-dialog modal-lg" role="content">
                 <!-- Modal content-->
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4>Login</h4>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                         <form method="post" action=#>
                             <div class="form-row">
                                 <div class="form-group col-sm-4">
                                      <label class="sr-only" for="inputName">Имя пользователя</label>
                                      <input type="text" class="form-control mr-1" id="inputName" placeholder="Имя пользователя" name="inputName">
                                 </div>
                                 <div class="form-group col-sm-4">
                                     <label class="sr-only" for="inputPassword">Пароль</label>
                                     <input type="password" class="form-control mr-1" id="inputPassword" placeholder="Пароль" name="inputPassword">
                                 </div>
                             </div>
                             <div class="form-row">
                                 <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Cancel</button>
                                 <button type="submit" class="btn btn-primary ml-1" name="singin" value="singin">Sign in</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
        <div id="logoutModal" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg" role="content">
                  <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Logout </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                          <form method="post" action=#>
                              <div class="form-row">
                                  <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-primary ml-1" name="singout" value="singout">Sign out</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        <!-- end Modal window login/logout -->
        <!-- header -->
        <header class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Сборник задач</h1>
                        <p>Сборник задач и упражнений</p>
                    </div>
                </div>
            </div>
        </header>
        <!-- body -->
        <div class="container">
            <!-- form for adding a task -->
            <div class="row">
                <div class="col-12">
                   <h3>Добавить задачу</h3>
                   <hr>
                </div>
                <div class="col-12">
                    <form method="post">
                        <div class="form-group row">
                            <label for="name" class="col-12 col-md-2 col-form-label"> Имя пользователя * </label>
                            <div class="col-5 col-md-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Имя пользователя" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-12 col-md-2 col-form-label"> Электронная почта * </label>
                            <div class="col-5 col-md-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="someone@example.com" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-12 col-md-2 col-form-label"> Текст задачи * </label>
                            <div class="col-7 col-md-10">
                                <textarea class="form-control" id="text" name="text" placeholder="Условие задачи" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-md-2 col-md-10">
                                <button type="submit" class="btn btn-primary" id="savetask" name="savetask" value='yes'> Сохранить </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end form for adding a task -->
            <hr>
            <!-- tasks table -->
            <div class="row row-content">
                <div class="col-12">
                    <h2>Таблица задач</h2>
                  <div class="table-responsive">
                        <table class="table table-striped" id="tasksTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="vertical-align:top">№</th>
                                    <th>
                                          <div class="title-message">
                                              Имя пользователя
                                              <div class="arrows-title-message">
                                                  <form method="post">
                                                      <div>
                                                          <input type="hidden" name="sort" value="name_desc">
                                                          <input type="image" src="<?=$sort == "name_desc" ? "images/double-up.png": "images/double-up-not.png" ?>" name = "sort" value="name_desc" width="10" height="10"/>
                                                      </div>
                                                  </form>
                                                  <form method="post">
                                                      <div>
                                                          <input type="hidden" name="sort" value="name_asc">
                                                          <input type="image" src="<?=$sort == "name_asc" ? "images/double-down.png":"images/double-down-not.png" ?>" name = "sort" value="name_asc" width="10" height="10" />
                                                      </div>
                                                  </form>
                                              </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="title-message">
                                              Электронная почта
                                              <div class="arrows-title-message">
                                                  <form method="post"><input type="hidden" name="sort" value="email_desc"/><div><input type="image" src=<?=$sort == "email_desc" ? "images/double-up.png": "images/double-up-not.png" ?>  name = "sort" value="email_desc" width="10" height="10"/></div></form>
                                                  <form method="post"><input type="hidden" name="sort" value="email_asc"/><div><input type="image" src=<?=$sort == "email_asc" ? "images/double-down.png":"images/double-down-not.png" ?> name = "sort" value="email_asc" width="10" height="10" /></div></form>
                                              </div>
                                        </div>
                                    </th>
                                    <th style="vertical-align:top">Текст задачи</th>
                                    <th>
                                        <div class="title-message">
                                            Отметка о выполнении
                                            <div class="arrows-title-message">
                                                <form method="post"><input type="hidden" name="sort" value="done_desc"/><div><input type="image" src=<?=$sort == "done_desc" ? "images/double-up.png": "images/double-up-not.png" ?>  name = "sort" value="done_desc" width="10" height="10"/></div></form>
                                                <form method="post"><input type="hidden" name="sort" value="done_asc"/><div><input type="image" src=<?=$sort == "done_asc" ? "images/double-down.png":"images/double-down-not.png" ?> name = "sort" value="done_asc" width="10" height="10" /></div></form>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                          </form>
                          <tbody>
                              <?php $i=1; $visable=""; ?>
                              <?php foreach($blocksOfTasks as $blockOfTasks): ?>
                                  <?php foreach($blockOfTasks as $task): ?>
                                      <tr id="visability<?= $i; ?>" <?= $visable; ?>>
                                        <th><?= $task['task_id']?></th>
                                        <td><?= htmlentities($task['name']) ?></td>
                                        <td><?= htmlentities($task['email']) ?></td>
                                        <td <?= isset($user['admin']) ? "contenteditable='true'" : "" ?>>
                                          <?= htmlentities($task['text']) ?>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="done" id="done" <?= htmlentities($task['check']) ?> <?= isset($user['admin']) ? "":"disabled" ?> >
                                            </div>
                                        </td>
                                     </tr>
                                     <?php $i += 1 ?>
                                     <?php endforeach; ?>
                                     <?php $visable = 'class=displayNone'; ?>
                                  <?php endforeach; ?>
                            </tbody>
                        </table>
                        <nav aria-label="Таблица задач">
                            <?php $activeCount = 1; $active = 'active' ?>
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $count === 1 ? 'disabled' : '' ?> " id="pagination-prev">
                                    <a href="#tasksTable" class="page-link" onClick="viewMessages(<?= count($blocksOfTasks) ?>, <?=$activeCount-1?>)"> Предыдущая </a>
                                </li>
                                <?php for($count = 1; $count<=count($blocksOfTasks); $count++): ?>
                                    <li class="page-item <?= $active ?>" id="pagination<?= $count ?>" ><a href="#tasksTable" class="page-link" onClick="viewMessages(<?=count($blocksOfTasks)?>, <?=$count?>)">
                                        <?= $count ?>
                                    </a></li>
                                    <?php $active = '' ?>
                                <?php endfor; ?>
                                <li class="page-item" id="pagination-follow"><a href="#tasksTable" class="page-link" onClick="viewMessages(<?=count($blocksOfTasks)?>, <?=$activeCount+1?>)"> Следующая </a></li>
                            </ul>
                       </nav>
                     </div>
                </div>
            </div>
            <!--end tasks table            -->
        </div>
        <!-- footer -->
        <footer class="footer bg-primary">
            <div class="container">
               <div class="row justify-content-right">
                    <div class="col-auto">
                        <p>© Copyright 2019 Olga Pivovarchyk (OP)</p>
                    </div>
               </div>
            </div>
        </footer>
        <!-- jQuery, Popper.js, Bootstrap JS. -->
        <script src="js/jquery.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/functions.js"></script>
      </body>
</html>
