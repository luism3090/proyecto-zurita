select timestampdiff(month,'2009-01-01','2010-12-01');

select *
from obras as o
inner join tipo_obra as t
on o.id_tipo_obra = t.id_tipo_obra;