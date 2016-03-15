--------------------------------
Larabros\\Elogram\\Entities\\Tag
--------------------------------

.. php:namespace: Larabros\\Elogram\\Entities

.. php:class:: Tag

    Tag

    .. php:attr:: client

        protected AdapterInterface

    .. php:method:: get($tag)

        Get information about a tag object.

        :type $tag: string
        :param $tag: Name of the tag
        :returns: Response

    .. php:method:: getRecentMedia($tag, $count = null, $minTagId = null, $maxTagId = null)

        Get a list of recently tagged media.

        :param $tag:
        :param $count:
        :type $minTagId: string|null
        :param $minTagId: Return media before this min_tag_id
        :type $maxTagId: string|null
        :param $maxTagId: Return media after this max_tag_id
        :returns: Response

    .. php:method:: search($tag)

        Search for tags by name.

        :type $tag: string
        :param $tag: Name of the tag
        :returns: Response

    .. php:method:: __construct(AdapterInterface $client)

        Creates a new instance of :php:class:`AbstractEntity`.

        :type $client: AdapterInterface
        :param $client:
