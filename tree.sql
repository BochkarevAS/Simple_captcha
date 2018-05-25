CREATE TABLE public.tree
(
  id serial,
  description integer,
  parent integer,
  CONSTRAINT tree_pkey PRIMARY KEY (id)
);

--------------------

INSERT INTO public.tree(description, parent)
    VALUES
            (1, 0),
            (2, 1),
            (3, 2),
            (4, 3),
            (5, 4),
            (6, 0),
            (7, 6),
            (8, 7),

--------------------

WITH RECURSIVE cte (id, description, parent, path, LEVEL) AS (
	SELECT t1.id, t1.description, t1.parent, CAST (t1.id AS char(50)) path, 1
	FROM public.tree t1
	WHERE t1.parent=0

	UNION

	SELECT t2.id, t2.description, t2.parent, CAST (cte.path ||'->'|| t2.id AS char(50)), LEVEL+1
	FROM public.tree t2
	JOIN cte ON (cte.id=t2.parent)
)

SELECT description, parent, path, LEVEL
FROM cte