Usage
-----

Using this bundle is almost equal to how you `use the Eloquent ORM in laravel`_.

Query Builder
-------------

You can use the `Query Builder`_:

.. code-block:: php

    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class DemoController extends Controller
    {
        public function indexAction()
        {
            $posts = DB::table('posts')->where('created_at', '>', '...')->get();

            return $this->render('AcmeDemoBundle:Demo:posts.html.twig', [
                'posts' => $posts,
            ]);
        }
    }

.. caution::

    Don't forget to `enable the DB aliases`_ if you want to use the ``DB``
    class directly. Otherwise, you have to include the
    ``WouterJ\EloquentBundle\Facade\DB`` class with a ``use`` statement.

Eloquent ORM
------------

If you enabled the eloquent ORM, you can also use the `Eloquent models`_. First
create a model:

.. code-block:: php

    namespace AppBundle\Model\Post;

    use Illuminate\Database\Eloquent\Model;

    class Post extends Model
    {
    }

Now, you can persist, fetch, delete and update your models where you like:

.. code-block:: php

    namespace AppBundle\Controller;

    use AppBundle\Model\Post;
    // ...

    public function indexAction()
    {
        $post = Post::find(1);

        return $this->render('post/single.html.twig', [
            'post' => $post,
        ]);
    }

Using Services instead of Facades
---------------------------------

You may prefer to use services instead of the magic Facades. The bundle
provides two useful services:

* ``wouterj_eloquent`` - This is the ``Capsule`` class, it can handle all core
  methods of the ``Schema`` and ``DB`` facades;
* ``wouterj_eloquent.database_manager`` - This service is equal to the ``DB``
  facade.

.. _`use the Eloquent ORM in laravel`: http://laravel.com/docs/database
.. _`Query Builder`: http://laravel.com/docs/queries
.. _`enable the DB aliases`: configuration.rst
.. _`Eloquent models`: http://laravel.com/docs/eloquent
